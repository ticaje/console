<?php
declare(strict_types=1);

/**
 * Crawler Reader Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Crawler;

use Exception;
use Ticaje\Crawler\Business\Policies\Crawler\ReaderInterface;
use Ticaje\Crawler\Business\Policies\Crawler\Strategy\ReaderStrategyInterface;

/**
 * Class Reader
 * @package Ticaje\Crawler\Business\Crawler
 */
class Reader implements ReaderInterface
{
    private $driver;

    /**
     * Reader constructor.
     * @param ReaderStrategyInterface $driver
     * The params should be injected using a dependency container so respecting dependency inversion principle
     */
    public function __construct(
        ReaderStrategyInterface $driver
    )
    {
        $this->driver = $driver;
    }

    /**
     * @inheritDoc
     */
    public function read(string $url): string
    {
        try {
            $content = $this->driver->read($url);
            return $content;
        } catch (Exception $exception) {
            return "Error {$exception->getMessage()}";
        }
    }
}

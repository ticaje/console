<?php
declare(strict_types=1);

/**
 * Crawler Reader Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Crawler;

use Exception;
use Ticaje\Crawler\Business\Policies\Crawler\ParserInterface;

class Parser implements ParserInterface
{
    private $pattern = '/<video\s[^>]*src=\"([^\"]*)\"[^>]*>(.*)<\/video>/siU'; // The pattern must belong to a module that manages patterns on a distributed basis

    private $domain;

    public function __construct(
        string $domain
    )
    {
        $this->domain = $domain;
    }

    /**
     * @inheritDoc
     */
    public function parse(string $content): bool
    {
        try {
            $links = $this->fetchMultimediaLinks($content);
            return !empty($links);
        } catch (Exception $exception) {
            return false;
        }

    }

    private function fetchMultimediaLinks($context)
    {
        if (preg_match_all($this->pattern, $context, $matches)) {
            return $matches[1] ?? '';
        }
        return null;
    }
}

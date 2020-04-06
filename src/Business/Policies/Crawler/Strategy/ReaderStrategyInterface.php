<?php
declare(strict_types=1);

/**
 * Crawler Interface
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Policies\Crawler\Strategy;

interface ReaderStrategyInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function read(string $url): string;
}

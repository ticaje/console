<?php
declare(strict_types=1);

/**
 * Crawler Parser Interface
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Policies\Crawler;

/**
 * Interface ParserInterface
 * @package Ticaje\Crawler\Business\Policies\Crawler
 */
interface ParserInterface
{
    /**
     * @param string $content
     * @return bool
     */
    public function parse(string $content): bool;
}

<?php
declare(strict_types=1);

/**
 * Crawler Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Crawler;

use Ticaje\Crawler\Business\Policies\Crawler\ReaderInterface;

/**
 * Class Reader
 * @package Ticaje\Crawler\Business\Crawler
 */
class Reader implements ReaderInterface
{
    public function read()
    {
        return true;
    }
}

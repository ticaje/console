<?php
declare(strict_types=1);

/**
 * Downloader interface
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Policies\Download;

/**
 * Interface DownloaderInterface
 * @package Ticaje\Crawler\Business\Policies\Download
 */
interface DownloaderInterface
{
    /**
     * @param string $url
     * @param string $destination
     * @return bool
     */
    public function download(string $url, string $destination): bool;
}

<?php
declare(strict_types=1);

/**
 * Downloader Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Download\Multimedia;

use Ticaje\Crawler\Business\Policies\Download\Multimedia\VideoInterface as VideoDownloaderInterface;

/**
 * Class Video
 * @package Ticaje\Crawler\Business\Download\Multimedia
 */
class Video implements VideoDownloaderInterface
{
    /**
     * @inheritDoc
     */
    public function download(string $url, string $destination): bool
    {
        $content = file_get_contents($url);
        $copied = file_put_contents($destination, $content);
        return $copied ? true : false;
    }
}

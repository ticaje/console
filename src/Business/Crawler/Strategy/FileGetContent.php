<?php
declare(strict_types=1);

/**
 * Crawler Reader Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Crawler\Strategy;

use Ticaje\Crawler\Business\Policies\Crawler\Strategy\ReaderStrategyInterface;

class FileGetContent implements ReaderStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function read(string $url): string
    {
        $opts = array(
            'https' => array(
                'method' => "GET",
            )
        );
        $context = stream_context_create($opts);
        $content = file_get_contents($url, false, $context);
        return $content;
    }
}

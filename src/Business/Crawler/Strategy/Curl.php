<?php
declare(strict_types=1);

/**
 * Crawler Reader Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Business\Crawler\Strategy;

use Ticaje\Crawler\Business\Policies\Crawler\Strategy\ReaderStrategyInterface;

class Curl implements ReaderStrategyInterface
{
    protected $userAgent = 'Mozilla/5.0 (X11; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0';

    /**
     * @inheritDoc
     */
    public function read(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result ? $result : "";
    }
}

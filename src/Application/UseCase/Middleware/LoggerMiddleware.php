<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\UseCase\Middleware;

use League\Tactician\Middleware;

class LoggerMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        echo "Start logging event....\n";

        return $next($command);
    }
}

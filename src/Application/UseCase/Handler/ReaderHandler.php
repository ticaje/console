<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\UseCase\Handler;

use League\Tactician\Middleware;
use Ticaje\Hexagonal\Application\Implementors\Responder\Response;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

class ReaderHandler implements Middleware, HandlerInterface
{
    public function execute($command, callable $next)
    {
        $result = $this->handle($command);
        $next($command);

        return $result;
    }

    public function handle(UseCaseCommandInterface $command): ResponseInterface
    {
        $result = $command->getId();
        $response = (new Response())
            ->setSuccess(true)
            ->setContent($result)
            ->setMessage('Successfully executed...');

        return $response;
    }
}


<?php
declare(strict_types=1);
/**
 * Use Case class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\UseCase\Handler;

use League\Tactician\Middleware;
use Ticaje\FileManager\Infrastructure\Driver\Iterator\SimpleIteratorInterface;
use Ticaje\FileManager\Infrastructure\Driver\Reader\Interfaces\FileInterface;
use Ticaje\Hexagonal\Application\Implementors\Responder\Response;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class ReaderHandler
 * @package Ticaje\Crawler\Application\UseCase\Handler
 */
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
        /** @var SimpleIteratorInterface $iterator */
        $iterator = $command->getIterator() ?? null;
        $result = $iterator ? $this->chunk($iterator) : $this->all($command->getManager());
        $response = (new Response())
            ->setSuccess(true)
            ->setContent($result)
            ->setMessage('Successfully executed...');

        return $response;
    }

    private function chunk(SimpleIteratorInterface $iterator): array
    {
        return $iterator->getChunk(0, 5);
    }

    /**
     * @param FileInterface $manager
     *
     * @return array
     */
    private function all(FileInterface $manager): array
    {
        $result = [];
        $content = $manager->getContent();
        $header = $manager->getHeader();
        $header = $header ? $header->toArray() : [];
        while ($content->valid()) {
            $item = $content->current();
            $content->next();
            $rawRowData = !empty($header) ? \array_combine($header, $item->toArray()) : $item->toArray();
            $result[] = $rawRowData;
        }

        return $result;
    }
}


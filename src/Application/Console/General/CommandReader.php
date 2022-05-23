<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console\General;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ticaje\Crawler\Application\Console\Base;
use Ticaje\Crawler\Application\UseCase\Command\ReaderCommand;
use Ticaje\Crawler\Application\UseCase\Handler\ReaderHandler;
use Ticaje\Crawler\Application\UseCase\Middleware\LoggerMiddleware;
use Ticaje\Crawler\Application\UseCase\Middleware\NotifierMiddleware;

use Ticaje\Hexagonal\Application\Implementors\UseCase\Bus\TacticianMiddleWare;
use Ticaje\Hexagonal\Application\UseCase\Bus\BusOrchrestator;

/**
 * Class CommandReader
 * @package Ticaje\Crawler\Application\Console\General
 */
class CommandReader extends Base
{
    protected $name = 'ticaje:command:read';

    protected $description = 'Read from any source';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Launching...");
        $this->launch($output);
        $output->writeln("Ending...");

        return 0;
    }

    private function launch(OutputInterface $output)
    {
        $this->decoratorBasedImplementation($output);
    }

    private function decoratorBasedImplementation(OutputInterface $output)
    {
        $implementor = new TacticianMiddleWare(
            [
                new NotifierMiddleware(),
                new LoggerMiddleware(),
                new ReaderHandler(),
            ]
        );
        $bus = new BusOrchrestator($implementor);
        $command = (new ReaderCommand())
            ->setId(45)
            ->setEmail('ticaje@filetea.me');
        $result = $bus->execute($command);
        print_r($result);
    }
}

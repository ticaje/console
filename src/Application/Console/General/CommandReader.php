<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console\General;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ticaje\Crawler\Application\Console\Base;
use Ticaje\Crawler\Application\UseCase\Command\ReaderCommand;
use Ticaje\Crawler\Application\UseCase\Handler\ReaderHandler;
use Ticaje\Crawler\Application\UseCase\Middleware\LoggerMiddleware;
use Ticaje\Crawler\Application\UseCase\Middleware\NotifierMiddleware;
use Ticaje\FileManager\Implementors\Reader\File\BoxSpout\Xlsx as Implementor;
use Ticaje\FileManager\Infrastructure\Driver\Iterator\SimpleIterator;
use Ticaje\FileManager\Infrastructure\Driver\Reader\File\Xlsx as FileAgent;
use Ticaje\Hexagonal\Application\Implementors\UseCase\Bus\TacticianMiddleWare;
use Ticaje\Hexagonal\Application\UseCase\Bus\BusOrchrestator;

/**
 * Class CommandReader
 * @package Ticaje\Crawler\Application\Console\General
 * This class is just an example of bringing hexagonal design to file reading task
 */
class CommandReader extends Base
{
    const OPTION_FILE = 'file';
    const OPTION_EMAIL = 'email';

    protected $name = 'ticaje:command:read';

    protected $description = 'Read from local file';

    private $email = 'ticaje@filetea.me';

    protected function configure()
    {
        $this->addOption(
            self::OPTION_FILE,
            null,
            InputOption::VALUE_REQUIRED,
            'file to read'
        );
        $this->addOption(
            self::OPTION_EMAIL,
            null,
            InputOption::VALUE_OPTIONAL,
            'email to notify'
        );
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Launching...");
        $this->launch($input, $output);
        $output->writeln("Ending...");

        return 0;
    }

    private function launch(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption(self::OPTION_FILE);
        if ($file === null) {
            $output->writeln('Please provide file to read');

            return 0;
        }
        $this->email = $input->getOption(self::OPTION_EMAIL) ?? $this->email;
        $this->decoratorBasedImplementation($output, $file);
    }

    private function decoratorBasedImplementation(OutputInterface $output, $file)
    {
        $implementor = new TacticianMiddleWare(
            [
                new NotifierMiddleware(),
                new LoggerMiddleware(),
                new ReaderHandler(),
            ]
        );
        $bus = new BusOrchrestator($implementor);
        $manager = $this->machinery($file);
        $command = (new ReaderCommand())
            ->setManager($manager)
            ->setIterator(new SimpleIterator($manager))
            ->setEmail($this->email);
        $result = $bus->execute($command);
        $output->write(json_encode($result->getContent(), JSON_FORCE_OBJECT));
    }

    private function machinery(string $file)
    {
        $implementor = new Implementor();
        $fileManager = new FileAgent($implementor, false); // gonna say it has header
        $fileManager->setSource($file);

        return $fileManager;
    }
}

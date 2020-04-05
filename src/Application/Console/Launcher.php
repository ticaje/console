<?php
declare(strict_types=1);

/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ticaje\Crawler\Business\Crawler\Reader;

/**
 * Class Launcher
 * @package Ticaje\Crawler\Application\Console
 */
class Launcher extends Base
{
    protected $name = 'ticaje:crawler:read';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Launching logic:");
        $this->launch($output);
        return 0;
    }

    public function launch(OutputInterface $output)
    {
        $reader = new Reader();
        $output->writeln($reader->read());
    }
}

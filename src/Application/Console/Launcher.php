<?php
declare(strict_types=1);

/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Launcher
 * @package Ticaje\Crawler\Application\Console
 */
class Launcher extends Base
{
    protected $name = 'ticaje:crawler:hello';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo 'Hello World';
        $output->writeln("We're just done");
        return 0;
    }
}

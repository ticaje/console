<?php
declare(strict_types=1);
/**
 * Trait Decorator
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Output\OutputInterface;

trait Decorator
{
    private function decorate(callable $logic, OutputInterface $output)
    {
        $start = microtime(true);
        $logic();
        $timeInSeconds = microtime(true) - $start;
        $output->writeln("It took {$timeInSeconds} seconds reading the file");
    }
}

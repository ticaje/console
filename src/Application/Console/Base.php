<?php
declare(strict_types=1);

/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Base
 * @package Ticaje\Crawler\Application\Console
 */
abstract class Base extends Command
{
    protected $name;

    protected $description;

    protected function configure()
    {
        $this->setName($name ?? $this->name);
        $this->setDescription($this->description ?? 'Description whatsoever');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);
    }
}

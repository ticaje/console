<?php
declare(strict_types=1);

/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ticaje\Crawler\Business\Crawler\Reader As CrawlerReader;
use Ticaje\Crawler\Business\Crawler\Strategy\Curl as CrawlerReaderDriver;

/**
 * Class Launcher
 * @package Ticaje\Crawler\Application\Console
 */
class Reader extends Base
{
    protected $name = 'ticaje:crawler:read';

    protected $description = 'Read source from URL';

    protected $url = 'http://localhost/crawler-example.html'; // This must be configurable

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Launching logic:");
        $this->launch($output);
        return 0;
    }

    public function launch(OutputInterface $output)
    {
        $reader = new CrawlerReader(new CrawlerReaderDriver());
        $output->writeln($reader->read($this->url));
    }
}

<?php
declare(strict_types=1);

/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ticaje\Crawler\Business\Crawler\Parser as ParserService;
use Ticaje\Crawler\Business\Crawler\Reader as ReaderService;
use Ticaje\Crawler\Business\Crawler\Strategy\Curl as CrawlerReaderDriver;


/**
 * Class Launcher
 * @package Ticaje\Crawler\Application\Console
 */
class Parser extends Base
{
    protected $name = 'ticaje:crawler:parse';

    protected $description = 'Parse source from URL';

    protected $url = 'http://localhost/crawler-example.html'; // This must be configurable(perhaps parameters)

    protected $domain = 'https://www.documaniatv.com/'; // This must be configurable(perhaps parameters)

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Launching logic:");
        $this->launch($output);
        return 0;
    }

    public function launch(OutputInterface $output)
    {
        $reader = new ReaderService(new CrawlerReaderDriver());
        $content = $reader->read($this->url);
        $parser = new ParserService($this->domain);
        $parsed = $parser->parse($content);
        $output->writeln($parsed ? 'Parsed successfully' : 'There was a problem parsing');
    }
}

<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console\File;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Ticaje\Crawler\Application\Console\Base;
use Ticaje\Crawler\Application\Console\Decorator;
use Ticaje\FileManager\Implementors\Reader\File\BoxSpout\Csv as ImplementorCsv;
use Ticaje\FileManager\Implementors\Reader\File\BoxSpout\Xlsx as Implementor;
use Ticaje\FileManager\Infrastructure\Driver\Iterator\SimpleIterator;
use Ticaje\FileManager\Infrastructure\Driver\Reader\File\Csv as FileAgentCsv;
use Ticaje\FileManager\Infrastructure\Driver\Reader\File\Xlsx as FileAgent;

/**
 * Class Reader
 * @package Ticaje\Crawler\Application\Console\General
 */
class Reader extends Base
{
    use Decorator;
    private const OPTION_FILE = 'file';

    protected $name = 'ticaje:file:read';

    protected $description = 'Read from any file';

    protected function configure()
    {
        $this->addOption(
            self::OPTION_FILE,
            null,
            InputOption::VALUE_REQUIRED,
            'file to read'
        );
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption(self::OPTION_FILE);
        if ($file === null) {
            $output->writeln('Please provide file to read');

            return 0;
        }
        try {
            $this->decorate(function () use ($file) {
                $this->readFileTicajeXls($file);
                //$this->readFileTicajeCsv($file);
            }, $output);
        } catch (\Throwable $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }

    private function readFileTicajeXls(string $file)
    {
        $implementor = new Implementor();
        $fileManager = new FileAgent($implementor, false); // gonna say it has header
        $fileManager->setSource($file);
        // Get rest of content
        $iterator = new SimpleIterator($fileManager);
        $header = $iterator->findRow(0);
        $chunk2 = $iterator->getChunk(0, 2);
        print_r($chunk2); exit;
        /** @var \Box\Spout\Common\Entity\Row $header */
        $header = $fileManager->getHeader();
        $header = $header ? $header->toArray() : [];
        $content = $fileManager->getContent();
        while ($content->valid()) {
            $item = $content->current(); //We could print content to stdout to seeing it in action.
            $content->next();
            $rawRowData = !empty($header) ? \array_combine($header, $item->toArray()) : $item->toArray();
            print_r($rawRowData);
        }
    }

    private function readFileTicajeCsv(string $file)
    {
        $implementor = new ImplementorCsv();
        $fileManager = new FileAgentCsv($implementor, true, ","); // gonna say it has header
        $fileManager->setSource($file);
        $content = $fileManager->getContent();
        // Get rest of content
        $iterator = new SimpleIterator($fileManager);
        $header = $iterator->findRow(0);
        $chunk = $iterator->getChunk(0, 3);

        /** @var \Box\Spout\Common\Entity\Row $header */
        $header = $fileManager->getHeader();
        $header = $header->toArray();
        while ($content->valid()) {
            $item = $content->current(); //We could print content to stdout to seeing it in action.
            $content->next();
            $rawRowData = \array_combine($header, $item->toArray());
            print_r($rawRowData);
        }
    }

}

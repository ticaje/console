<?php
declare(strict_types=1);

/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ticaje\Crawler\Business\Download\Multimedia\Video as VideoDownloaderDriver;

/**
 * Class Launcher
 * @package Ticaje\Crawler\Application\Console
 */
class Downloader extends Base
{
    protected $name = 'ticaje:crawler:downloader';

    protected $description = 'Download source from URL';

    protected $url = 'https://fs1.cnubis.com/Ycq?download_token=0a1cd36fbb1994740127f2ce49fcd7b9ed6758399d33043bde2b2fedf76030e3&amp;.mp4'; // This must be configurable

    protected $destination = __DIR__ . "/../../../public/my-video.mp4";

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Launching logic:");
        $this->launch($output);
        return 0;
    }

    public function launch(OutputInterface $output)
    {
        $downloader = new VideoDownloaderDriver();
        $output->writeln($downloader->download($this->url, $this->destination));
    }
}

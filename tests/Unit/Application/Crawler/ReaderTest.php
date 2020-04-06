<?php
declare(strict_types=1);

/**
 * Test Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Test\Unit\Application\Crawler;

use PHPUnit\Framework\TestCase as ParentClass;
use Ticaje\Crawler\Business\Crawler\Reader;
use Ticaje\Crawler\Business\Crawler\Strategy\Curl;

/**
 * Class Reader
 * @package Ticaje\Crawler\Test\Unit\Application\Crawler
 */
class ReaderTest extends ParentClass
{
    protected $correctUrl = 'http://localhost/crawler-example.html';

    protected $inCorrectUrl = 'https://www.google.local/';

    protected $reader;

    public function setUp()
    {
        $this->reader = new Reader(new Curl());
        parent::setUp();
    }

    public function testCorrectUrlRead()
    {
        $this->assertNotEmpty($this->reader->read($this->correctUrl), 'Check not empty');
        $this->assertContains('Error', $this->reader->read($this->correctUrl), 'Check error message');
    }

    public function testIncorrectUrlRead()
    {
        $this->assertEmpty($this->reader->read($this->inCorrectUrl), 'Asserting returning false when incorrect URL');
    }

}

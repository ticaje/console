<?php
declare(strict_types=1);

/**
 * Test Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Test\Unit\Application\Crawler;

use PHPUnit\Framework\TestCase as ParentClass;
use Ticaje\Crawler\Business\Crawler\Parser;
use Ticaje\Crawler\Business\Crawler\Reader;
use Ticaje\Crawler\Business\Crawler\Strategy\Curl;

/**
 * Class Reader
 * @package Ticaje\Crawler\Test\Unit\Application\Crawler
 */
class ParserTest extends ParentClass
{
    protected $domain = 'https://www.google.com/';

    protected $url = 'http://localhost/crawler-example.html';

    protected $parser;

    protected $reader;

    public function setUp()
    {
        $this->initialize();
        parent::setUp();
    }

    public function testDomainIsPassedThrough()
    {
        $this->assertNotNull($this->domain);
    }

    public function testReturnEmptyArrayWhenPassingNoContent()
    {
        $this->assertEmpty($this->parser->parse(''));
    }

    public function testReturnTrueWhenPassingContent()
    {
        $content = $this->reader->read($this->url);
        $this->assertTrue($this->parser->parse($content));
    }

    private function initialize()
    {
        $this->parser = new Parser($this->domain);
        $this->reader = new Reader(new Curl());
    }
}

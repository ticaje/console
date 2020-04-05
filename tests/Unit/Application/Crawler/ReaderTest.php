<?php
declare(strict_types=1);

/**
 * Test Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Test\Unit\Application\Crawler;

use PHPUnit\Framework\TestCase as ParentClass;
use Ticaje\Crawler\Business\Crawler\Reader;

/**
 * Class Reader
 * @package Ticaje\Crawler\Test\Unit\Application\Crawler
 */
class ReaderTest extends ParentClass
{
    protected $reader;

    public function setUp()
    {
        $this->reader = new Reader();
        parent::setUp();
    }

    public function testRead()
    {
        $this->assertTrue($this->reader->read());
    }
}

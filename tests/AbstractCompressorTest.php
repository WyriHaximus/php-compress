<?php declare(strict_types=1);

namespace WyriHaximus\Compress\Tests;

use WyriHaximus\Compress\CompressorInterface;
use WyriHaximus\TestUtilities\TestCase;

abstract class AbstractCompressorTest extends TestCase
{
    /**
     * @var CompressorInterface
     */
    protected $compressor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->compressor = $this->getCompressor();
    }

    public function testCompress(): void
    {
        self::assertStringContainsString('foo', $this->compressor->compress('foo'));
    }

    abstract protected function getCompressor(): CompressorInterface;
}

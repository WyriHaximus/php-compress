<?php declare(strict_types=1);

namespace WyriHaximus\Compress;

use PHPUnit\Framework\TestCase;

abstract class AbstractCompressorTest extends TestCase
{
    /**
     * @var CompressorInterface
     */
    protected $compressor;

    protected function setUp(): void
    {
        $this->compressor = $this->getCompressor();
    }

    public function testCompress(): void
    {
        self::assertStringContainsString('foo', $this->compressor->compress('foo'));
    }

    abstract protected function getCompressor(): CompressorInterface;
}

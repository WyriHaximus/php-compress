<?php

declare(strict_types=1);

namespace WyriHaximus\Compress\Tests;

use WyriHaximus\Compress\CompressorInterface;
use WyriHaximus\Compress\ReturnCompressor;
use WyriHaximus\Compress\SmallestResultCompressor;
use WyriHaximus\Compress\TestUtilities\AbstractCompressorTest;

/** @internal */
final class SmallestResultCompressorTest extends AbstractCompressorTest
{
    /** @return iterable<array<string|CalledCompressorInterface>> */
    public function provideCompressors(): iterable
    {
        $compressorA = new class () implements CalledCompressorInterface {
            public bool $called = false;

            public function getCalled(): bool
            {
                return $this->called;
            }

            public function compress(string $string): string
            {
                $this->called = true;

                return 'ab';
            }
        };
        $compressorB = new class () implements CalledCompressorInterface {
            public bool $called = false;

            public function getCalled(): bool
            {
                return $this->called;
            }

            public function compress(string $string): string
            {
                $this->called = true;

                return 'efgh';
            }
        };
        $compressorC = new class () implements CalledCompressorInterface {
            public bool $called = false;

            public function getCalled(): bool
            {
                return $this->called;
            }

            public function compress(string $string): string
            {
                $this->called = true;

                return 'abcd';
            }
        };

        $compressorD = new class () implements CalledCompressorInterface {
            public bool $called = false;

            public function getCalled(): bool
            {
                return $this->called;
            }

            public function compress(string $string): string
            {
                $this->called = true;

                return '';
            }
        };

        yield ['ab', $compressorA, $compressorC, $compressorB];
        yield ['ab', $compressorC, $compressorB, $compressorA];
        yield ['ab', $compressorC, $compressorD, $compressorA];
        yield ['abcd', $compressorC, $compressorB, $compressorB];
    }

    /** @dataProvider provideCompressors */
    public function testCompressToSmallest(string $expectedOutput, CalledCompressorInterface ...$compressors): void
    {
        $input      = 'abcdefgh';
        $compressor = new SmallestResultCompressor(...$compressors);
        $actual     = $compressor->compress($input);

        foreach ($compressors as $compressorX) {
            self::assertTrue($compressorX->getCalled());
        }

        self::assertSame($expectedOutput, $actual);
    }

    protected function getCompressor(): CompressorInterface
    {
        return new SmallestResultCompressor(new ReturnCompressor());
    }
}

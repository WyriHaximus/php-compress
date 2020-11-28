<?php

declare(strict_types=1);

namespace WyriHaximus\Compress;

final class ReturnCompressor implements CompressorInterface
{
    public function compress(string $string): string
    {
        return $string;
    }
}

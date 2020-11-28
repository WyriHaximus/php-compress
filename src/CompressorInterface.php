<?php

declare(strict_types=1);

namespace WyriHaximus\Compress;

interface CompressorInterface
{
    public function compress(string $string): string;
}

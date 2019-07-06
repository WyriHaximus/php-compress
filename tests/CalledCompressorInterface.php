<?php declare(strict_types=1);

namespace WyriHaximus\Compress\Tests;

use WyriHaximus\Compress\CompressorInterface;

interface CalledCompressorInterface extends CompressorInterface
{
    public function getCalled(): bool;
}

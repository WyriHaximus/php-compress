<?php

declare(strict_types=1);

namespace WyriHaximus\Compress;

use function strlen;

final readonly class SmallestResultCompressor implements CompressorInterface
{
    private const int ZERO = 0;

    /** @var array<CompressorInterface> */
    private array $compressors;

    public function __construct(CompressorInterface ...$compressors)
    {
        $this->compressors = $compressors;
    }

    public function compress(string $string): string
    {
        $result = $string;
        foreach ($this->compressors as $compressor) {
            $resultLength        = strlen($result);
            $currentResult       = $compressor->compress($string);
            $currentResultLength = strlen($currentResult);

            if ($currentResultLength === self::ZERO) {
                continue;
            }

            if ($currentResultLength >= $resultLength) {
                continue;
            }

            $result = $currentResult;
        }

        return $result;
    }
}

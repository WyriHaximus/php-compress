<?php declare(strict_types=1);

namespace WyriHaximus\Compress\Tests;

use WyriHaximus\Compress\CompressorInterface;
use WyriHaximus\Compress\ReturnCompressor;

/**
 * @internal
 */
final class ReturnCompressorTest extends AbstractCompressorTest
{
    public function providerReturn(): iterable
    {
        yield 'spacing-at-the-start' => [
          " <html>\r\t<body>\n\t\t<h1>hoi</h1>\r\n\t</body>\r\n</html>",
          " <html>\r\t<body>\n\t\t<h1>hoi</h1>\r\n\t</body>\r\n</html>",
        ];
        yield 'spacing-in-the-middle' => [
          "<html>\r\t<h1>h            oi</h1>\r\n\t\r\n</html>",
          "<html>\r\t<h1>h            oi</h1>\r\n\t\r\n</html>",
        ];
    }

    /**
     * @dataProvider providerReturn
     * @param mixed $input
     * @param mixed $expected
     */
    public function testReturn($input, $expected): void
    {
        $actual = (new ReturnCompressor())->compress($input);
        self::assertSame($expected, $actual);
    }

    protected function getCompressor(): CompressorInterface
    {
        return new ReturnCompressor();
    }
}

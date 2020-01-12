<?php

/*
 * This file is part of the Iphpjs package.
 *
 * (c) NetworkRanger <admin@iphpjs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Iphpjs\Encoder\Base\Base32;
use Iphpjs\Encoder\Base\Base32Encoder;

class Base32Test extends PHPUnit\Framework\TestCase
{
    /**
     * @covers Base32::encode()
     * @covers Base32::decode()
     * @throws Exception
     */
    public function testRandom()
    {
        for ($i = 1; $i < 32; ++$i) {
            for ($j = 0; $j < 50; ++$j) {
                $random = \random_bytes($i);

                $enc = Base32::encode($random);
                $this->assertSame(
                    $random,
                    Base32::decode($enc)
                );
            }
        }
    }


    /**
     * Tests Base32->decode()
     *
     * Testing test vectors according to RFC 4648
     * http://www.ietf.org/rfc/rfc4648.txt
     * @covers Base32::decode()
     */
    public function testDecode()
    {
        // RFC test vectors say that empty string returns empty string
        $this->assertEquals('', Base32::decode(''));

        // these strings are taken from the RFC
        $this->assertEquals('f', Base32::decode('MY======'));
        $this->assertEquals('fo', Base32::decode('MZXQ===='));
        $this->assertEquals('foo', Base32::decode('MZXW6==='));
        $this->assertEquals('foob', Base32::decode('MZXW6YQ='));
        $this->assertEquals('fooba', Base32::decode('MZXW6YTB'));
        $this->assertEquals('foobar', Base32::decode('MZXW6YTBOI======'));
        // Decoding a string made up entirely of invalid characters
        $this->assertEquals('', Base32::decode('8908908908908908'));
    }

    /**
     * Encoder tests, reverse of the decodes
     * @covers Base32::encode()
     */
    public function testEncode()
    {
        $base32 = new Base32();
        $this->assertEquals('MY======', $base32->encode('f'));


        // RFC test vectors say that empty string returns empty string
        $this->assertEquals('', Base32::encode(''));

        // these strings are taken from the RFC
        $this->assertEquals('MY======', Base32::encode('f'));
        $this->assertEquals('MZXQ====', Base32::encode('fo'));
        $this->assertEquals('MZXW6===', Base32::encode('foo'));
        $this->assertEquals('MZXW6YQ=', Base32::encode('foob'));
        $this->assertEquals('MZXW6YTB', Base32::encode('fooba'));
        $this->assertEquals('MZXW6YTBOI======', Base32::encode('foobar'));
    }
}

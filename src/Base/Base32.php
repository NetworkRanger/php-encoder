<?php

/*
 * This file is part of the Iphpjs package.
 *
 * (c) NetworkRanger <admin@iphpjs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iphpjs\Encoder\Base;

use Iphpjs\Contracts\Encoding\Encoder as EncoderContract;
use Iphpjs\Encoder\Encoder;

/**
 * Base32 encoder and decoer
 *
 * @link https://tools.ietf.org/html/rfc4648
 * Class Base32 RFC 4648
 * @package Iphpjs\Encoder\Base
 */
class Base32Encoder implements EncoderContract
{
    const CHAR_SET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    const PADDING = '=';

    /**
     * Encode the given value.
     *
     * @param string $value
     * @param array $options
     * @return string
     */
    public function encode(string $value, array $options = []): string
    {
        if (strlen($value) == 0) return '';

        // Convert string to binary
        $binaryString = '';
        foreach (str_split($value) as $s) {
            // Return each character as an 8-bit binary string
            $binaryString .= sprintf('%08b', ord($s));
        }

        // Break into 5-bit chunks, then break that into an array
//        $binaryArray = $this->chunk($binaryString, 5);
        $binaryArray = str_split($binaryString, 5);

        // Pad array to be divisible by 8
        $binaryArray = array_pad($binaryArray, ceil(count($binaryArray) / 8) * 8, null);

        $base32String = '';
        // Encode in base32
        foreach ($binaryArray as $bin) {
            if (!is_null($bin)) {// Base32 character
                // Pad the binary strings
                $bin = str_pad($bin, 5, 0, STR_PAD_RIGHT);
                $char = bindec($bin);

                $base32String .= self::CHAR_SET[$char];
            } else {
                $base32String .= self::PADDING;
            }

        }
        return $base32String;
    }

    /**
     * Decode the given encoded value.
     *
     * @param string $encodedValue
     * @param array $options
     * @return string
     */
    public function decode(string $encodedValue, array $options = []): string
    {
        // Only work in upper cases
        $base32String = strtoupper($encodedValue);
        // Remove anything that is not base32 alphabet
        $pattern = '/[^A-Z2-7]/';
        $base32String = preg_replace($pattern, '', $base32String);

        if (strlen($base32String) == 0) return '';

        $base32Array = str_split($base32String);
        $string = '';
        foreach ($base32Array as $str) {
            $char = strpos(self::CHAR_SET, $str);
            // Ignore the padding character
            if ($char !== false) {
                $string .= sprintf('%05b', $char);
            }
        }
        $string = substr($string, 0, floor(strlen($string) / 8) * 8);

        $binaryArray = str_split($string, 8);
        $realString = '';
        foreach ($binaryArray as $bin) {
            // Pad each value to 8 bits
            $bin = str_pad($bin, 8, 0, STR_PAD_RIGHT);
            // Convert binary strings to ASCII
            $realString .= chr(bindec($bin));
        }
        return $realString;
    }
}

class Base32 extends Encoder
{
    protected static function getFacadeRoot(): EncoderContract
    {
        return new Base32Encoder();
    }
}

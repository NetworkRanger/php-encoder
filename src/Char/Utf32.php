<?php

/*
 * This file is part of the Iphpjs package.
 *
 * (c) NetworkRanger <admin@iphpjs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iphpjs\Encoder\Char;

use Iphpjs\Contracts\Encoding\Encoder as EncoderContract;

class Utf32 implements EncoderContract
{

    /**
     * Encode the given value.
     *
     * @param string $value
     * @param array $options
     * @return string
     */
    public function encode(string $value, array $options = []): string
    {
        return \iconv('UTF-8', 'UTF-32', $value);
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
        $arr = \str_split(\bin2hex($encodedValue), 8);
        $str = '';
        foreach ($arr as $value) {
            $str .= '\u' . \substr($value, 4);
        }

        $str = \sprintf('{"decode": "%s"}', $str);
        return \json_decode($str, true)['decode'];
    }
}

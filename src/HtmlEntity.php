<?php

/*
 * This file is part of the Iphpjs package.
 *
 * (c) NetworkRanger <admin@iphpjs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iphpjs\Encoder;

use Iphpjs\Contracts\Encoding\Encoder as EncoderContract;

//class HtmlEntity implements EncoderContract
//{
//
//    public function encode(string $string, array $options = []): string
//    {
//        return \htmlentities($string);
//    }
//
//    public function decode(string $string, array $options = []): string
//    {
//        return \html_entity_decode($string);
//    }
//}
class HtmlEntity implements EncoderContract
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
        return \htmlentities($value);
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
        return \htmlspecialchars_decode($encodedValue);
    }
}

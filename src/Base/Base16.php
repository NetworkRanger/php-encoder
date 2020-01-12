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

/**
 * @see https://tools.ietf.org/html/rfc4648
 * Class Base16 RFC 4648
 * @package Iphpjs\Encoder\Base
 */
class Base16 implements EncoderContract
{
    const CHAR_SET = '0123456789ABCDEF';

    /**
     * Encode the given value.
     *
     * @param string $value
     * @param array $options
     * @return string
     */
    public function encode(string $value, array $options = []): string
    {
        return \strtoupper(\bin2hex($value));
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
        return \hex2bin($encodedValue);
    }
}

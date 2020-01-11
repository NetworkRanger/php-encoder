<?php

/*
 * This file is part of the Iphpjs package.
 *
 * (c) NetworkRanger <admin@iphpjs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iphpjs\Encoder\Escape;

use Iphpjs\Contracts\Encoding\Encoder as EncoderContract;

class Unicode implements EncoderContract
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
        \preg_match_all('/./u', $value, $matches);

        $str = '';
        foreach ($matches[0] as $m) {
            $str .= '\u' . \substr(\bin2hex(\iconv('UTF-8', 'UCS-4', $m)), 4);
        }
        return $str;
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
        $str = \sprintf('{"decode": "%s"}', $encodedValue);
        return \json_decode($str, true)['decode'];
    }
}

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
use Iphpjs\Support\Facades\Facade as Facade;

/**
 * @method static string encode(string $value, array $options = [])
 * @method static string decode(string $encodedValue, array $options = [])
 * Class Encoder
 * @package Iphpjs\Encoder
 */
abstract class Encoder extends Facade
{
    abstract protected static function getFacadeRoot(): EncoderContract;
}

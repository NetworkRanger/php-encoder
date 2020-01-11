<?php

/*
 * This file is part of the Iphpjs package.
 *
 * (c) NetworkRanger <admin@iphpjs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

date_default_timezone_set('PRC');

$loader_path = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($loader_path)) {
    echo "Dependencies must be installed using composer:\n\n";
    echo "php composer.phar install\n\n";
    echo "See http://getcomposer.org for help with installing composer\n";
    exit(1);
}

$loader = include $loader_path;
$loader->add('', __DIR__);

<?php
/**
 * This file is part of RedisClient.
 * git: https://github.com/cheprasov/php-redis-client
 *
 * (C) Alexander Cheprasov <cheprasov.84@ya.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace rmrevin\yii\fontawesome;

spl_autoload_register(
    function ($class) {
        if (0 !== strpos($class, __NAMESPACE__ . '\\')) {
            return;
        }

        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        $classPath = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        //echo $classPath;exit;
        if (is_file($classPath)) {
            include $classPath;
        }
    },
    false,
    true
);

<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

$cache = [
    'class' => yii\caching\FileCache::class,
    'cachePath' => '@backend/runtime/cache'
];

if (YII_ENV_DEV) {
    $cache = [
        'class' => yii\caching\DummyCache::class
    ];
}

return $cache;

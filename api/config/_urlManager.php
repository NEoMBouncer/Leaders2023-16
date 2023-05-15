<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'OPTIONS v1/<path:.+>' => 'site/options',
        // Api
        ['pattern' => 'site/docs', 'route' => 'site/index'],
        ['pattern' => 'v1/signup', 'route' => 'user/sign-in/signup'],
        ['pattern' => 'v1/login', 'route' => 'user/sign-in/login'],
        ['pattern' => 'v1/logout', 'route' => 'user/sign-in/logout'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/article', 'only' => ['index', 'view', 'options']],
    ]
];

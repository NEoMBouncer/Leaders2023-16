<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'OPTIONS v1/<path:.+>' => 'site/options',
        'GET,HEAD users' => 'user/index',
        // Api
        ['pattern' => 'site/docs', 'route' => 'site/index'],
        ['pattern' => 'v1/signup', 'route' => 'user/sign-in/signup'],
        ['pattern' => 'v1/login', 'route' => 'user/sign-in/login'],

        ['pattern' => 'v1/cabinet/get-info', 'route' => 'cabinet/user/get-info'],
        ['pattern' => 'v1/cabinet/profile', 'route' => 'cabinet/user/profile'],
        ['pattern' => 'v1/cabinet/update-profile', 'route' => 'cabinet/user/update-profile'],
        ['pattern' => 'v1/cabinet/change-password', 'route' => 'cabinet/user/change-password'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/article', 'only' => ['index', 'view', 'options']],
    ]
];

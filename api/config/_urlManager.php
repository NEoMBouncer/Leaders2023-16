<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'OPTIONS v1/<path:.+>' => 'site/options',

//        // Api
        ['pattern' => 'v1/signup', 'route' => 'v1/sign-in/signup'],
        ['pattern' => 'v1/login', 'route' => 'v1/sign-in/login'],

        ['pattern' => 'v1/cabinet/countries', 'route' => 'cabinet/user/countries'],
        ['pattern' => 'v1/cabinet/specializations', 'route' => 'cabinet/user/specializations'],
        ['pattern' => 'v1/cabinet/essay', 'route' => 'cabinet/user/essay'],

        ['pattern' => 'v1/cabinet/get-info', 'route' => 'cabinet/user/get-info'],
        ['pattern' => 'v1/cabinet/profile', 'route' => 'cabinet/user/profile'],
        ['pattern' => 'v1/cabinet/update-profile', 'route' => 'cabinet/user/update-profile'],
        ['pattern' => 'v1/cabinet/change-password', 'route' => 'cabinet/user/change-password'],
    ]
];

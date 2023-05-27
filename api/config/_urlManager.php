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
        ['pattern' => 'v1/cabinet/directions', 'route' => 'cabinet/user/directions'],
        ['pattern' => 'v1/cabinet/essay', 'route' => 'cabinet/user/essay'],
        ['pattern' => 'v1/cabinet/delete-essay/<id>', 'route' => 'cabinet/user/delete-essay'],
        ['pattern' => 'v1/cabinet/get-info', 'route' => 'cabinet/user/get-info'],
        ['pattern' => 'v1/cabinet/profile', 'route' => 'cabinet/user/profile'],
        ['pattern' => 'v1/cabinet/update-profile', 'route' => 'cabinet/user/update-profile'],
        ['pattern' => 'v1/cabinet/change-password', 'route' => 'cabinet/user/change-password'],
        ['pattern' => 'v1/cabinet/add-education', 'route' => 'cabinet/user/add-education'],
        ['pattern' => 'v1/cabinet/add-experience', 'route' => 'cabinet/user/add-experience'],
        ['pattern' => 'v1/cabinet/next-stage', 'route' => 'cabinet/user/next-stage'],

        ['pattern' => 'v1/cabinet/get-candidate', 'route' => 'cabinet/candidate/get-candidate'],
        ['pattern' => 'v1/cabinet/create-candidate-order', 'route' => 'cabinet/candidate/create-order'],
        ['pattern' => 'v1/cabinet/update-direction/<id>', 'route' => 'cabinet/candidate/update-direction'],

        // Supervisor
        ['pattern' => 'v1/cabinet/list-candidate', 'route' => 'supervisor/user/list-candidate'],
    ]
];

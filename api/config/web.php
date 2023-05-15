<?php

use api\modules\v1\Module;

$config = [
    'homeUrl' => Yii::getAlias('@apiUrl'),
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'v1' => Module::class,
        'user' => [
            'class' => common\modules\user\Module::class,
            'shouldBeActivated' => false,
            'enableLoginByPass' => false,
        ],
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => common\components\maintenance\Maintenance::class,
            'enabled' => function ($app) {
                if (env('APP_MAINTENANCE') === '1') {
                    return true;
                }
                return $app->keyStorage->get('backend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key'   => env('JWT_SECRET'),
            'jwtValidationData' => \common\components\jwt\JwtValidationData::class,
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'format' => yii\web\Response::FORMAT_JSON,
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->statusCode >= 300 && $response->statusCode != 500) {
                    $response->data = Array(
                        'success' => $response->isSuccessful,
                        'error' => $response->data['name'],
                        'message' => $response->data['message']
                    );
                }
            },
        ],
    ]
];

return $config;

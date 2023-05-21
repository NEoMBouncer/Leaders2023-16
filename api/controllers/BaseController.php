<?php

namespace api\controllers;

use common\components\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Base controller
 */
class BaseController extends Controller
{

    public function init()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    /**
     * @remove csrf for contact action
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors'  => [
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'except' => ['options']
        ];
        return $behaviors;
    }
}

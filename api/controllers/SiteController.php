<?php declare(strict_types=1);

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\Response;

class SiteController extends Controller
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors'  => [
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
            ],
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'docs' => [
                'class' => \yii2mod\swagger\SwaggerUIRenderer::class,
                'restUrl' => Url::to(['site/json-schema']),
            ],
            'json-schema' => [
                'class' => \yii2mod\swagger\OpenAPIRenderer::class,
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@api/modules/v1/controllers'),
                    Yii::getAlias('@api/modules/v1/models'),
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['site/docs']);
    }

    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof \HttpException) {
            Yii::$app->response->setStatusCode($exception->getCode());
        } else {
            Yii::$app->response->setStatusCode(500);
        }

        return $this->asJson(['error' => $exception->getMessage(), 'code' => $exception->getCode()]);
    }
}
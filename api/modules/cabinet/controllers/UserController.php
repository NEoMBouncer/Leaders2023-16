<?php

namespace api\modules\cabinet\controllers;

use api\controllers\BaseController;
use api\modules\cabinet\models\UserProfile;
use common\modules\user\models\ChangePasswordForm;
use Yii;
use yii\rest\OptionsAction;
use yii\web\Response;

class UserController extends BaseController
{

    public function init()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
                'collectionOptions' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
                'resourceOptions' => ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
            ]
        ];
    }

    public function actionGetInfo(): array
    {
        $user = Yii::$app->user->identity;
        if ($user)
            return ['success' => true, 'data' => [
                'email' => $user->email,
                'role' => $user->userProfile->role,
                'scores' => $user->userProfile->scores,
                'avatar' => $user->userProfile->avatar
            ]];
        else {
            Yii::$app->response->setStatusCode(421);
            return ['success' => false, 'error' => 'Не удалось идентифицировать пользователя'];
        }
    }

    public function actionProfile(): array
    {
        $profile =  UserProfile::findOne(['user_id' => Yii::$app->user->identity->id]);
        return ['success' => true, 'data' => $profile];
    }

    public function actionUpdateProfile(): array
    {
        $profile = UserProfile::findOne(['user_id' => Yii::$app->user->identity->id]);
        $params = Yii::$app->request->post();
        try {
            if ($profile->load($params, '') && $profile->validate())
            {
                $profile->save();
                return ['success' => true];
            }
            else
            {
                $response = ['success' => false];
                Yii::$app->response->setStatusCode(422);
                $modelErrors = $profile->getErrors();
                foreach ($modelErrors as $fieldError => $errors)
                {
                    $response['error'] = $errors[0];
                    break;
                }
                return $response;
            }
        }
        catch (\Exception $exception)
        {
            Yii::$app->response->setStatusCode(500);
            return ['success' => false, 'error' => $exception->getMessage()];
        }
    }

    public function actionChangePassword(): array
    {
        $user = Yii::$app->user->identity;
        $response = ['success' => false];
        try {
            $model = new ChangePasswordForm();

            $model->setUser($user);
            $model->attributes = Yii::$app->request->post();

            if ($model->validate() && $model->save()) {
                return ['success' => true];
            }
            Yii::$app->response->setStatusCode(422);
            $modelErrors = $model->getErrors();
            foreach ($modelErrors as $fieldError => $errors)
            {
                $response['error'] = $errors[0];
                break;
            }

            return $response;
        }
        catch (\Exception $exception)
        {
            Yii::$app->response->setStatusCode(500);
            return ['success' => false, 'error' => $exception->getMessage()];
        }
    }
}
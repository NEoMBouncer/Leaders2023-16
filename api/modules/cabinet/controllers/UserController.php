<?php

namespace api\modules\cabinet\controllers;

use api\controllers\BaseController;
use api\modules\cabinet\models\Essay;
use api\modules\cabinet\models\InternshipDirection;
use api\modules\cabinet\models\Specialization;
use api\modules\cabinet\models\UserProfile;
use common\models\Country;
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
                'firstname' => $user->userProfile->firstname,
                'lastname' => $user->userProfile->lastname,
//                'avatar' => $user->userProfile->avatar
            ]];
        else {
            Yii::$app->response->setStatusCode(421);
            return ['success' => false, 'error' => 'Не удалось идентифицировать пользователя'];
        }
    }

    public function actionCountries(): array
    {
        $countriesArray = Country::find()->select(['title', 'id'])->indexBy('id')->column();
        $countries = [];

        $locale = Yii::$app->user->identity ? Yii::$app->user->identity->userProfile->locale : 'ru-RU';
        foreach ($countriesArray as $key => $value)
            $countries[] = [
                'id' => $key,
                'name' => \Yii::t('countries', $value, null, $locale)
            ];

        return ['success' => true, 'data' => $countries];
    }

    public function actionSpecializations(): array
    {
        $specializations = Specialization::find()->all();
        return ['success' => true, 'data' => $specializations];
    }

    public function actionDirections(): array
    {
        $directions = InternshipDirection::find()->all();
        return ['success' => true, 'data' => $directions];
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

    public function actionEssay(): array
    {
        try {
            $user = Yii::$app->user->identity;
            $essays = $user->getEssay($user->id);
            if (Yii::$app->request->isPost)
            {
                if (count($essays) < 3)
                {
                    $essay = new Essay();
                    if ($essay->load(Yii::$app->request->post(), '') && $essay->validate())
                    {
                        $essay->user_id = $user->id;
                        $essay->save();
                        return ['success' => true];
                    }
                    else return ['success' => false, 'error' => 'Не удалось сохранить эссе'];
                }
                else return ['success' => false, 'error' => 'Может быть максимум 3 эссе'];
            }
            elseif (Yii::$app->request->isPut)
            {
                $essay = Essay::findOne(Yii::$app->request->post('id'));
                if ($essay)
                {
                    if ($essay->user_id === $user->id)
                    {
                        if ($essay->load(Yii::$app->request->post(), '') && $essay->validate())
                        {
                            $essay->save();
                            return ['success' => true];
                        }
                        else return ['success' => false, 'error' => 'Не удалось сохранить эссе'];
                    }
                    else
                    {
                        Yii::$app->response->setStatusCode(403);
                        return ['success' => false, 'У вас нет доступа к этому эссе'];
                    }
                }
                else return ['success' => false, 'error' => 'Нет эссе с таким идентификатором'];
            }
            else
            {
                if (isset(Yii::$app->request->queryParams['id']))
                {
                    $essay_id = Yii::$app->request->queryParams['id'];
                    $essay = Essay::findOne($essay_id);
                    if ($essay)
                    {
                        if ($essay->user_id === $user->id)
                            return ['success' => true, 'data' => $essay];
                        else
                        {
                            Yii::$app->response->setStatusCode(403);
                            return ['success' => false, 'У вас нет доступа к этому эссе'];
                        }
                    }
                     else return ['success' => false, 'error' => 'Нет эссе с таким идентификатором'];
                }
                else return ['success' => true, 'data' => $essays];
            }
        }
        catch (\Exception $exception)
        {
            Yii::$app->response->setStatusCode(500);
            return ['success' => false, 'error' => 'Server error'];
        }
    }

    public function actionDeleteEssay($id): array
    {
        try {
            if (Yii::$app->request->isDelete)
            {
                $user = Yii::$app->user->identity;
                $essay = Essay::findOne($id);
                if ($essay)
                {
                    if ($essay->user_id === $user->id)
                    {
                        $essay->delete();
                        return ['success' => true];
                    }
                    else
                    {
                        Yii::$app->response->setStatusCode(403);
                        return ['success' => false, 'У вас нет доступа к этому эссе'];
                    }
                }
                else return ['success' => false, 'error' => 'Нет эссе с таким идентификатором'];
            }
            else
            {
                Yii::$app->response->setStatusCode(400);
                return ['success' => false, 'error' => 'Неверный метод запроса'];
            }
        }
        catch (\Exception $exception)
        {
            Yii::$app->response->setStatusCode(500);
            return ['success' => false, 'error' => 'Server error'];
        }
    }
}
<?php

namespace common\modules\user\models;

use common\models\User;
use common\modules\user\Module;
use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    /**
     * @var
     */
    public $password_confirm;
    /**
     * @var
     */
    private $user = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('app', 'This username has already been taken.')
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('app', 'This email address has already been taken.')
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'E-mail'),
            'password' => Yii::t('app', 'Password'),
            'password_confirm' => Yii::t('app', 'Confirm Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @throws Exception
     */
    public function signup($ref = null)
    {
        if ($this->validate()) {
            $shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);

//            if ($ref != null)
//            {
//                $parent = User::findOne(['partners_link' => $ref]);
//                if ($parent)
//                    $user->parent_id = $parent->id;
//            }

            if (!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };

            if ($shouldBeActivated) {
                $activationForm = new ActivationForm($user);
                $activationForm->activate();
            }

            return true;
        }

        return false;
    }


    /**
     *
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function shouldBeActivated()
    {
        /** @var Module $userModule */
        $userModule = Yii::$app->getModule('user');
        if (!$userModule) {
            return false;
        } elseif ($userModule->shouldBeActivated) {
            return true;
        } else {
            return false;
        }
    }
}

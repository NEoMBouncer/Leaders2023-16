<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $position
 * @property string $avatar
 * @property integer $gender
 * @property int $age
 * @property string $city
 * @property string $phone
 * @property integer $country_id
 * @property int $role
 * @property int $is_russian_citizenship
 * @property int $scores
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    protected $_oldAttributes;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const ROLE_CANDIDATE = 0;
    const ROLE_INTERN = 1;
    const ROLE_SUPERVISOR = 2;
    const ROLE_MENTOR = 3;
    const ROLE_ORGANIZATION_MEMBER = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    public static function roles()
    {
        return [
            self::ROLE_CANDIDATE => Yii::t('common', 'Candidate'),
            self::ROLE_INTERN => Yii::t('common', 'Intern'),
            self::ROLE_SUPERVISOR => Yii::t('common', 'Supervisor'),
            self::ROLE_MENTOR => Yii::t('common', 'Mentor'),
            self::ROLE_ORGANIZATION_MEMBER => Yii::t('common', 'Organization member'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'gender', 'role', 'is_russian_citizenship', 'country_id'], 'integer'],
            ['scores', 'integer', 'min' => 0],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['firstname', 'middlename', 'lastname', 'avatar'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => 'ru-RU'],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],

            ['role', function ($attribute, $params) {
                if ($this->_oldAttributes['role'] != $this->$attribute &&
                    $this->_oldAttributes['role'] == self::ROLE_CANDIDATE) {
                    $candidate = Candidate::findOne($this->user_id);
                    $candidate->is_deleted = 1;
                    $candidate->save();
                }
            }]
        ];
    }

    public function afterFind()
    {
        $this->_oldAttributes = $this->attributes;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() // TODO
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'Middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'locale' => Yii::t('common', 'Locale'),
            'gender' => Yii::t('common', 'Gender'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }

    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $default;
    }
}

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
 * @property string $age
 * @property string $city
 * @property string $phone
 * @property integer $country_id
 * @property int $role
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
            [['user_id', 'gender', 'role', 'country_id'], 'integer'],
            ['scores', 'integer', 'min' => 0],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['firstname', 'middlename', 'lastname', 'city', 'phone', 'avatar', 'age'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => 'ru-RU'],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            ['phone', 'match', 'pattern' => '/^[+][0-9]{5,15}$/', 'skipOnEmpty' => true, 'message' => 'Формат номера телефона должен начинаться с + и содержать от 5 до 15 символов'],

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
        return parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        $candidate = Candidate::findOne($this->user_id);
        if ($candidate)
            self::checkCandidateRecommended($this->user_id);
        parent::afterSave($insert, $changedAttributes);
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

    public static function checkCandidateRecommended($user_id)
    {
//        $user = User::findOne($user_id);
//        $candidate = Candidate::find()->where(['user_id' => $user_id])->limit(1)->one();
//        $candidateOrder = CandidateOrder::find()->where(['candidate_id' => $candidate->id])
//            ->orderBy('id DESC')->limit(1)->one();
//
//        // Проверка возраста
//        $age = intdiv(time() - ($user->userProfile->age / 1000), 31536000);
//        $checkAge = $age <= 35 && $age >= 18;
//
//        //Проверка гражданства
//        $checkCitizenship = $user->userProfile->country_id === 192;
//
//        //Проверка образования
//        $education = $user->userProfile->education;
//        $checkEducation = false;
//        if (gettype($education) == 'array')
//        {
//            foreach ($education as $value)
//            {
//                if (array_key_exists('endSchool', $value))
//                    $checkEducation = $value['endSchool'] - date('Y') <= 1;
//                if ($checkEducation === true)
//                    break;
//            }
//        }
//
//        //Проверка опыта работы
//        $experience = $user->userProfile->experience;
//        $checkExperience = false;
//        if (gettype($experience) == 'array' && $candidateOrder)
//        {
//            foreach ($experience as $value)
//            {
//                if (array_key_exists('keySkills', $value))
//                {
//                    $specializationsArray = InternshipDirection::getSkills($candidateOrder->direction_id);
//                    foreach ($value['keySkills'] as $keySkill)
//                        if (in_array($keySkill, $specializationsArray))
//                        {
//                            $checkExperience = true;
//                            break;
//                        }
//                }
//                if ($checkExperience === true)
//                    break;
//            }
//        }
//
//        // Проверка на рекомендованность
//        $recommended = $checkAge && $checkCitizenship && $checkExperience && $checkEducation;
//        if ($recommended === true)
//            $candidate->is_recommended = 1;
//        else $candidate->is_recommended = 0;
//        $candidate->save();

    }
}

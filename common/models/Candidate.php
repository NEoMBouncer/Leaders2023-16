<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property int $user_id
 * @property int $direction_id
 * @property string $universities
 * @property string $education
 * @property string $experience
 * @property int $is_recommended
 * @property int $testing_status
 * @property int $is_deleted
 *
 * @property User $user
 */
class Candidate extends ActiveRecord
{
    const NOT_RECOMMENDED = 0;
    const RECOMMENDED = 1;


    const TESTING_STATUS_NONE = 0;
    const TESTING_STATUS_SUCCESS = 1;
    const TESTING_STATUS_FAILED = 2;
    const TESTING_STATUS_IN_PROGRESS = 3;
    const TESTING_STATUS_PENDING = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%candidate}}';
    }

    public static function testingStatuses(): array
    {
        return [
            self::TESTING_STATUS_NONE => 'Не пройдено',
            self::TESTING_STATUS_SUCCESS => 'Успешно',
            self::TESTING_STATUS_FAILED => 'Провалено',
            self::TESTING_STATUS_IN_PROGRESS => 'В процессе',
            self::TESTING_STATUS_PENDING => 'Ожидает результатов тестирования',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'direction_id', 'is_recommended', 'testing_status', 'is_deleted'], 'integer'],
            [['universities' , 'education', 'experience'], 'string'],
            ['testing_status', 'default', 'value' => self::TESTING_STATUS_NONE]
        ];
    }

    public function beforeValidate() {
        $this->universities = serialize($this->universities);
        $this->education = serialize($this->education);
        $this->experience = serialize($this->experience);
        return parent::beforeValidate();
    }

    public function afterFind() {
        $this->universities = unserialize($this->universities);
        $this->education = unserialize($this->education);
        $this->experience = unserialize($this->experience);
        return parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if (!$this->isNewRecord)
        {
            $user = User::findOne($this->user_id);
            if ($user->userProfile->is_russian_citizenship) // TODO добавить проверку на курс и опыт работы
                $this->is_recommended = self::RECOMMENDED;
            else $this->is_recommended = self::NOT_RECOMMENDED;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'direction_id' => Yii::t('common', 'Direction ID'),
            'universities' => Yii::t('common', 'Universities'),
            'education' => Yii::t('common', 'Education'),
            'experience' => Yii::t('common', 'Experience'),
            'is_recommended' => Yii::t('common', 'Recommended'),
            'testing_status' => Yii::t('common', 'Testing status'),
            'is_deleted' => Yii::t('common', 'Deleted'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

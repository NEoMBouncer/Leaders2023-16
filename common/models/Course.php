<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Course model
 *
 * @property integer $id
 * @property int $date_start
 * @property int $date_end
 * @property int $status
 */
class Course extends ActiveRecord
{

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end', 'status'], 'integer'],
        ];
    }

    public static function statuses()
    {
        return [
            self::STATUS_NOT_ACTIVE => 'Не активен',
            self::STATUS_ACTIVE => 'Активен',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date_start' => Yii::t('common', 'Date start'),
            'date_end' => Yii::t('common', 'Date end'),
            'status' => Yii::t('common', 'Status')
        ];
    }

    public static function getActiveCourse()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE])->orderBy('date_start DESC')->one();
    }

    public static function getLast()
    {
        return self::find()->orderBy('id DESC')->one();
    }
}

<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Education model
 *
 * @property integer $id
 * @property string $date_start
 * @property string $date_end
 * @property int $user_id
 * @property int $level
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $speciality
 */
class Education extends ActiveRecord
{

    const LEVEL_HIGH = 0;
    const LEVEL_BACHELOR = 1;
    const LEVEL_MAGISTRACY = 2;
    const LEVEL_DOCTOR = 3;
    const LEVEL_CANDIDATE = 4;
    const LEVEL_MVA = 5;
    const LEVEL_AVERAGE_GENERAL = 6;
    const LEVEL_AVERAGE_PROFESSIONAL = 7;
    const LEVEL_OTHER = 8;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%education}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'level'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['name', 'address', 'city', 'speciality'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_start', 'date_end'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_start', 'date_end'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ]
        ];
    }

    public static function levels()
    {
        return [
            self::LEVEL_HIGH => 'Среднее',
            self::LEVEL_BACHELOR => 'Высшее - бакалавриат',
            self::LEVEL_MAGISTRACY => 'Высшее - магистратура',
            self::LEVEL_DOCTOR => 'Доктор наук',
            self::LEVEL_CANDIDATE => 'Кандидат наук',
            self::LEVEL_MVA => 'Мва',
            self::LEVEL_AVERAGE_GENERAL => 'Среднее общее',
            self::LEVEL_AVERAGE_PROFESSIONAL => 'Среднее профессиональное',
            self::LEVEL_OTHER => 'Прочее',
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
        ];
    }
}

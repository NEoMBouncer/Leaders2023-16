<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Education model
 *
 * @property integer $id
 * @property int $date_start
 * @property int $date_end
 * @property int $user_id
 * @property int $level
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $speciality
 */
class Education extends ActiveRecord
{

    const LEVEL_AVERAGE = 0;
    const LEVEL_BACHELOR = 1;
    const LEVEL_MAGISTRACY = 2;
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
            [['user_id', 'level', 'date_start', 'date_end'], 'integer'],
            [['name', 'address', 'city', 'speciality'], 'string', 'max' => 255],
        ];
    }

    public static function levels()
    {
        return [
            self::LEVEL_AVERAGE => 'Среднее',
            self::LEVEL_BACHELOR => 'Высшее - бакалавриат',
            self::LEVEL_MAGISTRACY => 'Высшее - магистратура',
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

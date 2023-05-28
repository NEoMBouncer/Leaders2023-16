<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Experience model
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $income
 * @property string $date_start
 * @property string $date_end
 * @property string $name
 * @property string $post
 * @property string $responsibilities
 * @property string $key_skills
 */
class Experience extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%experience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['income', 'number', 'min' => 0],
            ['user_id', 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['name', 'post'], 'string', 'max' => 255],
            [['responsibilities', 'key_skills'], 'string'],
        ];
    }

    public function afterFind()
    {
        $this->key_skills = unserialize($this->key_skills);
        return parent::afterFind();
    }

    public function beforeValidate() {
        $this->key_skills = serialize($this->key_skills);
        return parent::beforeValidate();
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

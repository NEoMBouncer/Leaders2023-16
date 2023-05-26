<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Intern model
 *
 * @property integer $id
 * @property integer $intern_id
 * @property integer $mentor_id
 * @property integer $vacancy_id
 * @property integer $status
 * @property integer $evaluate
 * @property integer $is_deleted
 */

class InternOrder extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%intern_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intern_id', 'mentor_id', 'vacancy_id', 'status', 'evaluate', 'is_deleted'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intern_id' => Yii::t('common', 'Intern ID'),
            'mentor_id' => Yii::t('common', 'Mentor ID'),
            'vacancy_id' => Yii::t('common', 'Vacancy ID'),
            'status' => Yii::t('common', 'Status'),
            'evaluate' => Yii::t('common', 'Evaluate'),
            'is_deleted' => Yii::t('common', 'Deleted'),
        ];
    }
}

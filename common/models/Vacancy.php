<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Mentor model
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $title
 * @property integer $status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Organization $organization
 */
class Vacancy extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            ['title', 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'organization_id' => Yii::t('common', 'Organization ID'),
            'organization_member_id' => Yii::t('common', 'Organization member ID'),
            'rating' => Yii::t('common', 'Rating'),
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

    /**
     * @return ActiveQuery
     */
    public function getOrganization(): ActiveQuery
    {
        return $this->hasOne(Organization::class, ['id' => 'organization_id']);
    }
}

<?php

namespace api\modules\member\models;

use api\modules\cabinet\models\InternshipDirection;
use Yii;

class Vacancy extends \common\models\Vacancy
{

    public function fields()
    {
        return [
            'id',
            'direction' => function(){
                $directions = InternshipDirection::find()->select('title')->indexBy('id')->column();

                $directions = array_map(function($direction) {
                    return Yii::t('directions', $direction);
                }, $directions);
                return ['direction_id' => $this->direction_id, 'list' => $directions];
            },
            'intern_id',
            'mentor_id',
            'organization' => function(){
                return $this->organization->title;
            },
            'income',
            'title',
            'address',
            'location' => function(){
                return unserialize($this->location);
            },
            'description',
            'schedule',
            'status',
            'is_publish'
        ];
    }
}

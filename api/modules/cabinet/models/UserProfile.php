<?php

namespace api\modules\cabinet\models;

use common\models\Country;

class UserProfile extends \common\models\UserProfile
{

    public function fields()
    {
        return [
            'firstname',
            'middlename',
            'lastname',
            'gender',
            'phone',
            'age',
            'city',
            'country_id' => function(){
                $countriesArray = Country::find()->select(['title', 'id'])->indexBy('id')->column();
                $list = [];
                foreach ($countriesArray as $id => $name)
                    $list[] = [
                        'id' => $id,
                        'name' => \Yii::t('countries', $name, null, 'ru-RU')
                    ];
                return ['value' => $this->country_id, 'list' => $list];
            },
            'education' => function() {
                return Education::find()->where(['user_id' => $this->user_id])->all();
            },
            'experience' => function() {
                return Experience::find()->where(['user_id' => $this->user_id])->all();
            },
            'scores'
        ];
    }
}

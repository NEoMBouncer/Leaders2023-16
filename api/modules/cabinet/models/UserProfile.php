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
                        'name' => $name
                    ];
                return ['value' => $this->country_id, 'list' => $list];
            },
            'education',
            'experience',
            'scores'
        ];
    }
}

<?php

namespace api\modules\cabinet\models;

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
            'is_russian_citizenship',
            'scores'
        ];
    }
}

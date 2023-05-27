<?php

namespace api\modules\cabinet\models;

class Experience extends \common\models\Experience
{

    public function fields()
    {
        return ['income', 'name', 'post', 'date_start', 'date_end', 'responsibilities',
            'key_skills' => function () {
                return unserialize($this->key_skills);
            }
        ];
    }
}

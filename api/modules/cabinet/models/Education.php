<?php

namespace api\modules\cabinet\models;

class Education extends \common\models\Education
{

    public function fields()
    {
        return ['id', 'level', 'name', 'address', 'city', 'speciality',
            'date_start' => function () {
                return strtotime($this->date_start);
            },
            'date_end' => function () {
                return strtotime($this->date_end);
            },
        ];
    }
}

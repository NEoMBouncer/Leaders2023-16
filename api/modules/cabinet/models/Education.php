<?php

namespace api\modules\cabinet\models;

class Education extends \common\models\Education
{

    public function fields()
    {
        return ['level', 'name', 'address', 'city', 'speciality', 'date_start', 'date_end'];
    }
}

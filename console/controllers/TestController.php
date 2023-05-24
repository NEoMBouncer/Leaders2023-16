<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class TestController extends Controller
{
    public function init()
    {
        parent::init();
    }

    public function actionCheckTest()
    {
        $i = '123456789';
        echo $i[-1]. "\n";
    }
}

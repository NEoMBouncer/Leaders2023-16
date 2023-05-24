<?php

namespace public\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        return render('/layouts/main.php');
    }

}

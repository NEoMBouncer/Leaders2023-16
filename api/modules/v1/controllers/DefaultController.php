<?php

namespace api\modules\v1\controllers;

use api\controllers\SiteController;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class DefaultController extends SiteController
{

    /**
     * @return array
     */
    public function actionIndex(): array
    {
        return ['succerss' => true, 'data' => 'test'];
    }
}

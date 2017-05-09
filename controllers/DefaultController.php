<?php

namespace zc\yii2Alisms\controllers;

use yii\web\Controller;

/**
 * Default controller for the `yii2Alisms` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

<?php
namespace frontend\controllers;

use Yii;
use yii\base\Controller;

/**
 * Site controller
 */

class SiteController extends Controller
{
    /**
     * Return main page
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

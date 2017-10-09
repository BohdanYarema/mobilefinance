<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;

/**
 * Site controller
 */

class SiteController extends ActiveController
{
    public $modelClass = 'common\models\Accounting';
}

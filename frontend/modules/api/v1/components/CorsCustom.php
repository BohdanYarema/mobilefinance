<?php
/**
 * Created by PhpStorm.
 * User: Bogdanek
 * Date: 30.10.17
 * Time: 22:30
 */

namespace frontend\modules\api\v1\components;

use Yii;
use yii\filters\Cors;

class CorsCustom extends  Cors

{
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            Yii::$app->getResponse()->getHeaders()->set('Allow', 'POST GET');
            Yii::$app->end();
        }
        return true;
    }
}
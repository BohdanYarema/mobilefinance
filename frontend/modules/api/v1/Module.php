<?php

namespace frontend\modules\api\v1;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\api\v1\controllers';

    public function init()
    {
        parent::init();
        Yii::$app->user->identityClass              = 'frontend\modules\api\v1\models\ApiUserIdentity';
        Yii::$app->user->enableSession              = false;
        Yii::$app->user->loginUrl                   = null;
        Yii::$app->user->enableAutoLogin            = null;
        Yii::$app->request->enableCsrfValidation    = false;
    }
}

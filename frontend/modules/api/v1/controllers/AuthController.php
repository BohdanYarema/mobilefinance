<?php

namespace frontend\modules\api\v1\controllers;

use yii\filters\Cors;
use yii\web\Controller;

/**
 * AuthController controller for the `api` module
 */
class AuthController extends Controller
{
    public $modelClass = 'frontend\modules\api\v1\models\ApiUserIdentity';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'login'  => ['POST', 'HEAD'],
            'signup' => ['POST', 'HEAD'],
            'upload' => ['POST', 'HEAD'],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'login' => [
                'class' => 'frontend\modules\api\v1\views\auth\LoginAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
            ],
            'upload' => [
                'class' => 'frontend\modules\api\v1\views\auth\UploadAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
            ],
            'signup' => [
                'class' => 'frontend\modules\api\v1\views\auth\SignupAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

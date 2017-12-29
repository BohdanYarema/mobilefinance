<?php
namespace frontend\modules\api\v1\controllers;

use frontend\modules\api\v1\components\CorsCustom;
use Yii;
use yii\filters\AccessControl;
use frontend\modules\api\v1\filters\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Accounting controller
 */

class UploadController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\models\Profile';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'upload'        => ['POST', 'HEAD', 'OPTIONS'],
            'profile'       => ['POST', 'HEAD', 'OPTIONS']
        ];
    }

    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class'     => HttpBearerAuth::className(),
            'only'      => ['upload', 'profile'],
            'except'    => ['options'],
        ];


        $behaviors[] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'only' => ['upload', 'profile'],
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'frontend\modules\api\v1\views\upload\UploadAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'profile' => [
                'class' => 'frontend\modules\api\v1\views\upload\ProfileAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

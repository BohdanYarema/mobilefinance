<?php
namespace frontend\modules\api\v1\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * Tags controller
 */

class TagsController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\models\Tags';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index'     => ['GET', 'HEAD'],
        ];
    }

    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class'     => HttpBearerAuth::className(),
            'only'      => ['index'],
            'except'    => ['options'],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index'],
            'rules' => [
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
                    'actions' => [
                        'options',
                    ],
                ],
            ],
        ];

        $behaviors[] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'only' => ['index'],
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
            'index' => [
                'class' => 'frontend\modules\api\v1\views\tags\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

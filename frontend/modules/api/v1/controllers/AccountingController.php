<?php
namespace frontend\modules\api\v1\controllers;

use Yii;
use yii\filters\AccessControl;
use frontend\modules\api\v1\filters\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Accounting controller
 */

class AccountingController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\models\Accounting';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'create'    => ['POST', 'HEAD', 'OPTIONS'],
            'index'     => ['GET', 'HEAD', 'OPTIONS'],
        ];
    }

    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class'     => HttpBearerAuth::className(),
            'only'      => ['index', 'create'],
            'except'    => ['options'],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index', 'create'],
            'rules' => [
                [
                    'actions' => ['index', 'create'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
                    'actions' => ['options'],
                    'roles' => ['?'],
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

        $behaviors[] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'only' => ['create'],
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
                'class' => 'frontend\modules\api\v1\views\accounting\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

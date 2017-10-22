<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Accounting controller
 */

class AccountingController extends ActiveController
{
    public $modelClass = 'frontend\models\Accounting';

    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['create'],
                'formats' => [
                    'text/xml' => \yii\web\Response::FORMAT_XML,
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'frontend\rest\accounting\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
//            'view' => [
//                'class' => 'yii\rest\ViewAction',
//                'modelClass' => $this->modelClass,
//                'checkAccess' => [$this, 'checkAccess'],
//            ],
            'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
//            'update' => [
//                'class' => 'yii\rest\UpdateAction',
//                'modelClass' => $this->modelClass,
//                'checkAccess' => [$this, 'checkAccess'],
//                'scenario' => $this->updateScenario,
//            ],
//            'delete' => [
//                'class' => 'yii\rest\DeleteAction',
//                'modelClass' => $this->modelClass,
//                'checkAccess' => [$this, 'checkAccess'],
//            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

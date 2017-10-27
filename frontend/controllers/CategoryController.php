<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Category controller
 */

class CategoryController extends ActiveController
{
    public $modelClass = 'frontend\models\Category';

    public function behaviors()
    {
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index'],
            'rules' => [
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
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
                'class' => 'frontend\rest\category\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

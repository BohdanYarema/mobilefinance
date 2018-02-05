<?php
namespace frontend\modules\api\v1\controllers;

use frontend\modules\api\v1\filters\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Statistic controller
 */

class StatisticController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\models\Category';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index'     => ['GET', 'HEAD', 'OPTIONS'],
        ];
    }

//    public function behaviors()
//    {
//        $behaviors['authenticator'] = [
//            'class'     => HttpBearerAuth::className(),
//            'only'      => ['index', 'timeline'],
//            'except'    => ['options'],
//        ];
//
//        $behaviors[] = [
//            'class' => \yii\filters\ContentNegotiator::className(),
//            'only' => ['index', 'timeline'],
//            'formats' => [
//                'application/json' => \yii\web\Response::FORMAT_JSON,
//            ],
//        ];
//
//        return $behaviors;
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'frontend\modules\api\v1\views\statistic\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'timeline' => [
                'class' => 'frontend\modules\api\v1\views\statistic\TimelineAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

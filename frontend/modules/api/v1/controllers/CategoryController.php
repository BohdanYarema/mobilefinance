<?php
namespace frontend\modules\api\v1\controllers;

use frontend\modules\api\v1\filters\HttpBearerAuth;
use Yii;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Category controller
 */

class CategoryController extends ActiveController
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

    public function behaviors()
    {
//        $behaviors = parent::behaviors();
//        unset($behaviors['authenticator']);
//
//        $behaviors['authenticator'] = [
//            'class'     => HttpBearerAuth::className(),
//            'only'      => ['index'],
//            'except'    => ['options'],
//        ];
//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'only' => ['index'],
//            'rules' => [
//                [
//                    'actions' => ['index'],
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//                [
//                    'allow' => true,
//                    'actions' => ['options'],
//                    'roles' => ['?'],
//                ],
//            ],
//        ];
//
//        $behaviors[] = [
//            'class' => \yii\filters\ContentNegotiator::className(),
//            'only' => ['index'],
//            'formats' => [
//                'application/json' => \yii\web\Response::FORMAT_JSON,
//            ],
//        ];

        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                ],
            ],
            'authenticator' => [
                'class' => HttpBearerAuth::className(),
                'except' => ['options'],
            ],
        ];

        //return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'frontend\modules\api\v1\views\category\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

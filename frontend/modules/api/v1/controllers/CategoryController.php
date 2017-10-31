<?php
namespace frontend\modules\api\v1\controllers;

use frontend\modules\api\v1\components\CorsCustom;
use frontend\modules\api\v1\filters\HttpBearerAuth;
use Yii;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * Category controller
 */

class CategoryController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\models\Category';

    public function beforeAction($action)
    {
        parent::beforeAction($action);

        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            // End it, otherwise a 401 will be shown.
            Yii::$app->end();
        }

        return true;
    }

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
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'class' => Cors::className(),
                #special rules for particular action
                'actions' => [
                    'index' => [
                        #web-servers which you alllow cross-domain access
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET'],
                        'Access-Control-Request-Headers' => ['*'],
                        'Access-Control-Allow-Credentials' => null,
                        'Access-Control-Max-Age' => 86400,
                        'Access-Control-Expose-Headers' => [],
                    ]
                ],
            ],
        ];

        $behaviors['authenticator'] = [
            'class'     =>  HttpBearerAuth::className(),
            'except'    => ['options'],
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

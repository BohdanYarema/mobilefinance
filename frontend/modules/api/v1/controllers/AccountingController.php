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
            'list'      => ['GET', 'HEAD', 'OPTIONS'],
            'map'       => ['GET', 'HEAD', 'OPTIONS'],
            'delete'    => ['DELETE', 'HEAD', 'OPTIONS']
        ];
    }

    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class'     => HttpBearerAuth::className(),
            'only'      => ['create', 'list', 'index', 'map', 'delete'],
            'except'    => ['options'],
        ];


        $behaviors[] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'only' => ['index', 'create', 'list', 'map', 'delete'],
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
            'list' => [
                'class' => 'frontend\modules\api\v1\views\accounting\ListAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'map' => [
                'class' => 'frontend\modules\api\v1\views\accounting\MapAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
            'delete' => [
                'class' => 'yii\rest\DeleteAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 25.12.2017
 * Time: 13:53
 */

namespace frontend\modules\api\v1\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\rest\ActiveController;


class UploadController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\models\Category';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'upload'     => ['POST', 'HEAD'],
            'profile'    => ['POST', 'HEAD'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'frontend\modules\api\v1\views\upload\UploadAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
            ],
            'profile' => [
                'class' => 'frontend\modules\api\v1\views\upload\ProfileAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}
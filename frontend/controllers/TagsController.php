<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;

/**
 * Tags controller
 */

class TagsController extends ActiveController
{
    public $modelClass = 'frontend\models\Tags';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'frontend\rest\tags\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

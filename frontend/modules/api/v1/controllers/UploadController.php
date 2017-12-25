<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 25.12.2017
 * Time: 13:53
 */

namespace frontend\modules\api\v1\controllers;


class UploadController
{
    public $modelClass = 'frontend\modules\api\v1\models\Category';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'upload'     => ['POST', 'HEAD', 'OPTIONS'],
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
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}
<?php

namespace frontend\modules\api\v1\views\auth;

use backend\models\SystemLog;
use Yii;
use yii\rest\Action;
use yii\web\HttpException;

class UploadAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
        if (Yii::$app->request->post()){

            $model = new SystemLog();
            $model->level = 4;
            $model->log_time = time();
            $model->prefix = "test";
            $model->category = 'test';
            $model->message = json_encode(['file' => $_FILES, 'post' => $_POST]);



            $model->save();
            exit();
        }
    }
}

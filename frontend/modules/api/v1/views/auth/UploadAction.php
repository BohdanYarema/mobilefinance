<?php

namespace frontend\modules\api\v1\views\auth;

use backend\models\SystemLog;
use Yii;
use yii\rest\Action;
use yii\web\HttpException;
use yii\web\UploadedFile;

class UploadAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
//        $model = new SystemLog();
//        $model->level = 4;
//        $model->log_time = time();
//        $model->prefix = "test";
//        $model->category = 'test';
//        $model->message = json_encode(['file' => $_FILES]);
//        $model->save();
//
//        if ($model->save()){
//            return true;
//        } else {
//            return false;
//        }
        $data = $_FILES;
        //$uploads = UploadedFile::getInstancesByName($_FILES['upfile']);
        $uploads = UploadedFile::getInstanceByName("upfile");

//        $_FILES = [
//            'upfile' => [
//                'name' => 'Знімок екрана 2017-11-02 о 23.31.06.png',
//                'type' => 'image/png',
//                'tmp_name' => '/private/var/tmp/php6KOugU',
//                'error' => 0,
//                'size' => 199634,
//            ],
//        ];

        $uploads->saveAs(Yii::getAlias("@web/fileupload/").'test.jpg');

        var_dump($uploads);
    }
}

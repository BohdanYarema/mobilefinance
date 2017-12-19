<?php

namespace frontend\modules\api\v1\views\auth;

use backend\models\SystemLog;
use Yii;
use yii\rest\Action;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class UploadAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
        $uploads = UploadedFile::getInstanceByName("upfile");
        if ($uploads == null){
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        } else {
            $ext = $uploads->getExtension();
            $uploads->saveAs(Yii::getAlias('@webroot/fileupload').'/'.Yii::$app->user->id."_".time()."_user_logo_".$ext);

            var_dump($uploads);
            exit();

            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);
        }
    }
}

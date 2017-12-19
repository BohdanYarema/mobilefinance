<?php

namespace frontend\modules\api\v1\views\auth;

use backend\models\SystemLog;
use common\models\UserProfile;
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

            var_dump(Yii::getAlias('@webroot/fileupload'));

            $model  = UserProfile::findOne(Yii::$app->user->id);
            $model->avatar_base_url = 'http://storage.mobilefinance.local.dev/source';
            $model->avatar_path     = '1/f1pVFmRXHzARx7FtW0Sfp4sjKqI-1aM0.jpg';
            $model->save();

            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);
        }
    }
}

<?php

namespace frontend\modules\api\v1\views\auth;

use backend\models\SystemLog;
use frontend\models\UserProfile;
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
            var_dump(json_encode($uploads));
//            $ext = $uploads->getExtension();
//            $name = Yii::$app->user->id."_".time()."_user_logo_".$ext;
//            $uploads->saveAs(Yii::getAlias('@storage/web/source/1/').$name);
//
//            $model  = UserProfile::find()->where(['user_id' => 1])->one();
//            $model->avatar_base_url = Yii::getAlias('@storageUrl').'/source';
//            $model->avatar_path     = '1/'.$name;
//            $model->save();
//
//            echo $model->getAvatar();
//
//            $response = Yii::$app->getResponse();
//            $response->setStatusCode(200);
        }
    }
}

<?php

namespace frontend\modules\api\v1\views\upload;

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
        $uploads = UploadedFile::getInstanceByName("ionicfile");

        if ($uploads == null){
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        } else {
            $id = 1;
            $ext = $uploads->getExtension();
            $name = $id."_".time()."_user_logo_".$ext;
            $uploads->saveAs(Yii::getAlias('@storage/web/source/1/').$name);

            $model = UserProfile::find()->where(['user_id' => $id])->one();
            $model->avatar_base_url = Yii::getAlias('@storageUrl').'/source';
            $model->avatar_path     = '1/'.$name;
            $model->save();

            echo json_encode($model);
        }
    }
}

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
            $uploads->saveAs(Yii::getAlias('@storage/web/source/1/').Yii::$app->user->id."_".time()."_user_logo_".$ext);

            $model  = UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one();
            //$model->avatar_base_url = Yii::getAlias('@storage/web/source');
            //$model->avatar_path     = '1/'.$uploads['name'];
            //$model->save();

            var_dump($model);
            var_dump($model->save());
            var_dump($model->getErrors());
            exit();

            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);
        }
    }
}

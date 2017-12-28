<?php

namespace frontend\modules\api\v1\views\upload;

use frontend\models\UserProfile;
use Yii;
use yii\rest\Action;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class ProfileAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
        if (!Yii::$app->request->post()){
            throw new HttpException('400', 'Test');
        } else {
            $id = 1;
            $post = Yii::$app->request->post();

            $model = UserProfile::find()->where(['user_id' => $id])->one();
            $model->firstname   = $post['firstname'];
            $model->lastname    = $post['lastname'];
            $model->middlename  = $post['middlename'];
            $model->gender      = $post['gender'];
            $model->save();

            return [
                'profile'   => $model
            ];
        }
    }
}

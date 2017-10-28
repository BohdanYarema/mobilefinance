<?php

namespace frontend\modules\api\v1\views\auth;

use frontend\modules\user\models\LoginForm;
use Yii;
use yii\rest\Action;

class LoginAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
        if (Yii::$app->request->post()){
            $username = Yii::$app->request->post("username");
            $password = Yii::$app->request->post("password");

            $model = new LoginForm();
            $model->identity = $username;
            $model->password = $password;

            if ($model->validate() && $model->login()){
                return json_encode([
                    'id'            => Yii::$app->user->identity->id,
                    'access_token'  => Yii::$app->user->identity->getAuthKey(),
                    'username'      => Yii::$app->user->identity->username,
                    'email'         => Yii::$app->user->identity->email,
                    'created_at'    => Yii::$app->user->identity->created_at,
                ]);
            }
        }
    }
}

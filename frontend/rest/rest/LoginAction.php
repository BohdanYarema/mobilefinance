<?php

namespace frontend\rest\rest;

use common\models\User;
use frontend\modules\user\models\LoginForm;
use Yii;
use yii\data\ActiveDataProvider;
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
                var_dump(['access_token' => Yii::$app->user->identity->getAuthKey()]);
                exit();
            }
        }
    }
}

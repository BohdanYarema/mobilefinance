<?php

namespace frontend\modules\api\v1\views\auth;

use frontend\modules\user\models\SignupForm;
use Yii;
use yii\rest\Action;

class SignupAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {
        if (Yii::$app->request->post()){
            $username   = Yii::$app->request->post("username");
            $email      = Yii::$app->request->post("email");
            $password   = Yii::$app->request->post("password");

            $model = new SignupForm();
            $model->username    = $username;
            $model->email       = $email;
            $model->password    = $password;
            $user               = $model->signup();

            if ($user && Yii::$app->getUser()->login($user)){
                return json_encode([
                    'id'            => Yii::$app->user->identity->id,
                    'access_token'  => Yii::$app->user->identity->getAuthKey(),
                    'username'      => Yii::$app->user->identity->username,
                    'email'         => Yii::$app->user->identity->email,
                    'avatar'        => Yii::$app->user->identity['userProfile']->getAvatar(),
                    'firstname'     => Yii::$app->user->identity['userProfile']->firstname,
                    'lastname'      => Yii::$app->user->identity['userProfile']->lastname,
                    'middlename'    => Yii::$app->user->identity['userProfile']->middlename,
                    'gender'        => Yii::$app->user->identity['userProfile']->gender,
                    'created_at'    => Yii::$app->user->identity->created_at,
                ]);
            } else {
                Yii::$app->response->statusCode = 401;
            }
        }
    }
}

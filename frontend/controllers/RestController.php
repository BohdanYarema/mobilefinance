<?php
namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

/**
 * Rest controller
 */

class RestController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBasicAuth::className();
        $behaviors['authenticator']['auth'] = function ($username, $password) {

            $user   = new User();
            $model  = $user->findByUsername($username);

            if (!$model || !$model->validatePassword($password)){
                return null;
            } else {
                return User::findOne([
                    'username'      => $username,
                    'password_hash' => $model->password_hash,
                ]);
            }
        };

        return $behaviors;
    }

}

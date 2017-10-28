<?php

namespace frontend\rest\rest;

use Yii;
use yii\rest\Action;

class DashboardAction extends Action
{
    /**
     * @return mixed
     */
    public function run()
    {

        var_dump($_SERVER);
        exit();

//        $response = [
//            'username'      => Yii::$app->user->identity->username,
//            'access_token'  => Yii::$app->user->identity->getAuthKey(),
//        ];
//        var_dump($response);
//        exit();
    }
}


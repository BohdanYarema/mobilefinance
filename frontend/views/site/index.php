<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 12.10.2017
 * Time: 11:46
 */
//phpinfo();
?>

<h1>Hi on our site !)))</h1>

<?php
    var_dump(Yii::getAlias('@storageUrl'));
$model  = \common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one();
var_dump($model);
var_dump(Yii::$app->user->id);

$model  = \frontend\models\UserProfile::find()->where(['user_id' => 1])->one();
$model->avatar_base_url = Yii::getAlias('@storageUrl').'/source';
$model->avatar_path     = '1/';
$model->save();
?>

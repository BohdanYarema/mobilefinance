<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Accounting */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categories common\models\Category[] */
/* @var $users common\models\User[] */
/* @var $gps_list \common\models\GpsData[] */

if ($model->isNewRecord){
    $model->gps_status = 0;
}

?>

<div class="accounting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'price')->textInput() ?>

    <?php echo $form->field($model, 'name')->textInput() ?>

    <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $categories,
        'id',
        'name'
    )) ?>

    <?php echo $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $users,
        'id',
        'username'
    )) ?>

    <?=$form->field($model, 'gps_status')->radioList([
        0 => 'List',
        1 => 'Fields'
    ])->label('What you want to use?');?>

    <?php echo $form->field($model, 'gps_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $gps_list,
        'id',
        'name'
    )) ?>

    <?php echo $form->field($model, 'gps_x')->textInput() ?>

    <?php echo $form->field($model, 'gps_y')->textInput() ?>

    <?php echo $form->field($model, 'gps_title')->textInput() ?>

    <?php echo $form->field($model, 'dates')->widget(
        \trntv\yii\datetime\DateTimeWidget::className(),
        [
            'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
        ]
    ) ?>

    <?php
        echo $form->field($model, 'type')->dropDownList([
            '1' => 'Наличные',
            '2' => 'Карточка',
        ]);
    ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

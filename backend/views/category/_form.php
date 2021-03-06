<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'thumbnail')->widget(
        \trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 50000000, // 5 MiB
        ]);
    ?>

    <?php
        echo $form->field($model, 'color')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => 'Select color ...', 'readonly' => true],
        ]);
    ?>
    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TagToAccounting */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $accounting common\models\Accounting[] */
/* @var $tags common\models\Tags[] */
?>

<div class="tag-to-accounting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'tags_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $tags,
        'id',
        'name'
    )) ?>

    <?php echo $form->field($model, 'accounting_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $accounting,
        'id',
        'name'
    )) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

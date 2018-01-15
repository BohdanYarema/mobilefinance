<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GpsData */

$this->title = 'Update Gps Data: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gps Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gps-data-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GpsData */

$this->title = 'Create Gps Data';
$this->params['breadcrumbs'][] = ['label' => 'Gps Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gps-data-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

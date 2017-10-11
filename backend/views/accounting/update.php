<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Accounting */
/* @var $categories common\models\Category[] */

$this->title = 'Update Accounting: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accounting-update">

    <?php echo $this->render('_form', [
        'model'         => $model,
        'categories'    => $categories
    ]) ?>

</div>

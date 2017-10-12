<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TagToAccounting */
/* @var $accounting common\models\Accounting[] */
/* @var $tags common\models\Tags[] */

$this->title = 'Update Tag To Accounting: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tag To Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-to-accounting-update">

    <?php echo $this->render('_form', [
        'model'         => $model,
        'accounting'    => $accounting,
        'tags'          => $tags
    ]) ?>

</div>

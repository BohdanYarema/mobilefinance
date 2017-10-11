<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Accounting */
/* @var $categories common\models\Category[] */

$this->title = 'Create Accounting';
$this->params['breadcrumbs'][] = ['label' => 'Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounting-create">

    <?php echo $this->render('_form', [
        'model'         => $model,
        'categories'    => $categories
    ]) ?>

</div>

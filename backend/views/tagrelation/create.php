<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TagToAccounting */
/* @var $accounting common\models\Accounting[] */
/* @var $tags common\models\Tags[] */

$this->title = 'Create Tag To Accounting';
$this->params['breadcrumbs'][] = ['label' => 'Tag To Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-to-accounting-create">

    <?php echo $this->render('_form', [
        'model'         => $model,
        'accounting'    => $accounting,
        'tags'          => $tags
    ]) ?>

</div>

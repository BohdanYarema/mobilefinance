<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AccountingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accountings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounting-index">
    <p>
        <?php echo Html::a('Create Accounting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'price',
            'dates',
            'status',
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

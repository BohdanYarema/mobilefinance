<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <p>
        <?php echo Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'class' => \common\grid\EnumColumn::className(),
                'attribute' => 'status',
                'enum' => [
                    Yii::t('backend', 'Not Published'),
                    Yii::t('backend', 'Published')
                ]
            ],
            'created_at:datetime',

            [
                'class'     => 'yii\grid\ActionColumn',
                'template'  => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>

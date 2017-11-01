<?php

namespace frontend\modules\api\v1\models;

use yii\helpers\Url;
use common\models\TagToAccounting;

/**
 *
 */
class Accounting extends \common\models\Accounting
{
    public function fields()
    {
        return [
            'id',
            'price',
            'name',
            'gps_x',
            'gps_y',
            'created_at',
            'tags' => function(){
                return $this->getTags();
            },
        ];
    }

    public function getTags()
    {
        $result = [];
        $tags = TagToAccounting::find()->joinWith("tags")->where(['accounting_id' => $this->id])->asArray()->all();

        return $tags;
    }
}
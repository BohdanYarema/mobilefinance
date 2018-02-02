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
            'user_id',
            'tags' => function(){
                return $this->getTags();
            },
            'thumbnail' => function(){
                return $this->getThumbnail();
            },
        ];
    }

    public function getThumbnail()
    {
        return $this->category->thumbnail_base_url."/".$this->category->thumbnail_path;
    }

    public function getTags()
    {
        $result = [];
        $tags = TagToAccounting::find()->joinWith("tags")->where(['accounting_id' => $this->id])->asArray()->all();

        return $tags;
    }
}
<?php

namespace frontend\modules\api\v1\models;

use yii\helpers\Url;

/**
 *
 */
class Category extends \common\models\Category
{
    public function fields()
    {
        return [
            'id',
            'name',
            'thumbnail' => function(){
                return $this->getThumbnail();
            },
        ];
    }

    public function getThumbnail()
    {
        return $this->thumbnail_base_url."/".$this->thumbnail_path;
    }
}
<?php

namespace frontend\modules\api\v1\models;


/**
 *
 */
class Tags extends \common\models\Tags
{
    public function fields()
    {
        return [
            'id',
            'name',
        ];
    }
}
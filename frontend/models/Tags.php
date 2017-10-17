<?php

namespace frontend\models;


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
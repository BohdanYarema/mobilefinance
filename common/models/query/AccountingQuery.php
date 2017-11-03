<?php

namespace common\models\query;


use yii\db\ActiveQuery;

/**
 * Class AccountingQuery
 * @package common\models\query
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AccountingQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function group()
    {
        $this->select(['id', 'dates']);
        $this->groupBy(['dates']);
        return $this;
    }
}
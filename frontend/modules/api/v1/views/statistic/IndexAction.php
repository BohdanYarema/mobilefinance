<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\api\v1\views\statistic;

use common\models\Category;
use frontend\modules\api\v1\models\Accounting;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class IndexAction extends Action
{
    public $prepareDataProvider;


    /**
     * @return array
     * @var $id integer
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        echo json_encode($this->prepareDataProvider());
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array
     * @var $id integer
     */
    protected function prepareDataProvider()
    {
        $count = (new \yii\db\Query())
            ->select('category_id, COUNT(id) as count')
            ->from('accounting')
            ->groupBy('category_id')
            ->all();

        $avg = (new \yii\db\Query())
            ->select('category_id, AVG(price) as avg')
            ->from('accounting')
            ->groupBy('category_id')
            ->all();

        $max = (new \yii\db\Query())
            ->select('category_id, MAX(price) as max')
            ->from('accounting')
            ->groupBy('category_id')
            ->all();

        $min = (new \yii\db\Query())
            ->select('category_id, MIN(price) as min')
            ->from('accounting')
            ->groupBy('category_id')
            ->all();

        $model = (new \yii\db\Query())
            ->select('category_id, SUM(price) as summary')
            ->from('accounting')
            ->groupBy('category_id')
            ->all();

        return [
            'summary'   => $model,
            'count'     => $count,
            'max'       => $max,
            'min'       => $min,
            'avg'       => $avg
        ];
    }
}

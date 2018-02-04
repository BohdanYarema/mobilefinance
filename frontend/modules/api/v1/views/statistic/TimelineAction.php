<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\api\v1\views\statistic;

use frontend\modules\api\v1\models\Accounting;
use yii\rest\Action;

class TimelineAction extends Action
{
    public $prepareDataProvider;


    /**
     * @return array
     * @var $id integer
     */
    public function run($month)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        echo json_encode($this->prepareDataProvider($month));
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array
     * @var $id integer
     */
    protected function prepareDataProvider($month)
    {
        $model = Accounting::find()->all();
        $result = [];
        foreach ($model as $item) {
            if (date('n',$item->dates) == $month){
                $result[] = $item;
            }
        }
        return $result;
    }
}

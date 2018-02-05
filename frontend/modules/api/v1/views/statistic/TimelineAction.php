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
    public function run($month, $year)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        echo json_encode($this->prepareDataProvider($month, $year));
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array
     * @var $id integer
     */
    protected function prepareDataProvider($month, $year)
    {
        $model = Accounting::find()
            ->select(['dates'])
            ->groupBy(['dates'])
            ->all();

        $result     = [];
        $response   = [];
        foreach ($model as $item) {
            if (date('n',$item->dates) == $month && date('Y',$item->dates) == $year){
                $data = Accounting::find()
                    ->where(['dates' => $item])
                    ->all();
                if (!empty($data)){
                    foreach ($data as $item){
                        $response[]['color']  = $item->category->color;
                        $response[]['id']     = $item->id;
                        $response[]['name']   = $item->name;
                        $response[]['dates']  = $item->dates;
                        $response[]['avatar'] = $item->category->thumbnail_base_url."/".$item->category->thumbnail_path;;
                    }
                    $result[$item->dates] = $response;
                }
            }
        }
        return $result;
    }
}

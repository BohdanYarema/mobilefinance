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
                $responses  = [];
                if (!empty($data)){
                    foreach ($data as $key => $value){
                        $response['color']      = $value->category->color;
                        $response['id']         = $value->id;
                        $response['gps_x']      = $value->gps_x;
                        $response['gps_y']      = $value->gps_y;
                        $response['price']      = $value->price;
                        $response['name']       = $value->name;
                        $response['time']       = date('d-m-Y', $value->dates);
                        $response['dates']      = $value->dates;
                        $response['avatar']     = $value->category->thumbnail_base_url."/".$value->category->thumbnail_path;;
                        $responses[] = $response;
                    }

                    $result[$item->dates] = [
                        'dates' => date('l, F j', $item->dates),
                        'data'  => $responses
                    ];
                }
            }
        }
        return $result;
    }
}

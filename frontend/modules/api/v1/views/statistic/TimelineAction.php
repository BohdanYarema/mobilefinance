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
    public function run($year, $month)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        echo json_encode($this->prepareDataProvider($year, $month));
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array
     * @var $id integer
     */
    protected function prepareDataProvider($year, $month)
    {
        $result = Accounting::find()->all();

        $data = [];
        $final = [];
        $response = [];

        foreach ($result as $item){
            $years   = date("Y", $item->dates);
            $data[$years] = [];
            foreach ($result as $value){
                if($years === date("Y", $value->dates)){
                    $data[$years][] = $value;
                }
            }
        }

        foreach ($data as $key => $value){
            foreach ($value as $item) {
                switch (date("n", $item->dates)){
                    case 1:
                        $response[$key][1][] = $item;
                        break;
                    case 2:
                        $response[$key][2][] = $item;
                        break;
                    case 3:
                        $response[$key][3][] = $item;
                        break;
                    case 4:
                        $response[$key][4][] = $item;
                        break;
                    case 5:
                        $response[$key][5][] = $item;
                        break;
                    case 6:
                        $response[$key][6][] = $item;
                        break;
                    case 7:
                        $response[$key][7][] = $item;
                        break;
                    case 8:
                        $response[$key][8][] = $item;
                        break;
                    case 9:
                        $response[$key][9][] = $item;
                        break;
                    case 10:
                        $response[$key][10][] = $item;
                        break;
                    case 11:
                        $response[$key][11][] = $item;
                        break;
                    case 12:
                        $response[$key][12][] = $item;
                        break;
                }
            }
        }

        if (array_key_exists($year, $final) && array_key_exists($month, $final[$year])){
            foreach ($response as $key => $years){
                foreach ($years as $months => $item) {
                    foreach ($item as $day) {
                        $date = date('j', $day->dates);
                        $final[$key][$months][date('l, F j', $day->dates)] = [];
                        $finder = [];
                        foreach ($item as $value) {
                            if ($date == date('j', $value->dates)){
                                $finder['color']      = $value->category->color;
                                $finder['id']         = $value->id;
                                $finder['gps_x']      = $value->gps_x;
                                $finder['gps_y']      = $value->gps_y;
                                $finder['price']      = $value->price;
                                $finder['name']       = $value->name;
                                $finder['time']       = date('d-m-Y', $value->dates);
                                $finder['dates']      = $value->dates;
                                $finder['avatar']     = $value->category->thumbnail_base_url."/".$value->category->thumbnail_path;
                                $final[$key][$months][date('l, F j', $day->dates)][] = $finder;
                            }
                        }
                    }
                }
            }
            return $final[$year][$month];
        } else {
            return [];
        }
    }
}

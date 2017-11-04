<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\api\v1\views\accounting;

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
        $response = [];
        $line = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0
        ];

        $bar = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
            13 => 0,
            14 => 0,
            15 => 0,
            16 => 0,
            17 => 0,
            18 => 0,
            19 => 0,
            20 => 0,
            21 => 0,
            22 => 0,
            23 => 0,
            24 => 0
        ];
        $doughnut = [];

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->all();

        foreach ($query as $item) {
            $mounth = date('m', $item->dates);
            switch ($mounth){
                case 1 : {
                    $line[1] += 1;
                    break;
                }
                case 2 : {
                    $line[2] += 1;
                    break;
                }
                case 3 : {
                    $line[3] += 1;
                    break;
                }
                case 4 : {
                    $line[4] += 1;
                    break;
                }
                case 5 : {
                    $line[5] += 1;
                    break;
                }
                case 6 : {
                    $line[6] += 1;
                    break;
                }
                case 7 : {
                    $line[7] += 1;
                    break;
                }
                case 8 : {
                    $line[8] += 1;
                    break;
                }
                case 9 : {
                    $line[9] += 1;
                    break;
                }
                case 10 : {
                    $line[10] += 1;
                    break;
                }
                case 11 : {
                    $line[11] += 1;
                    break;
                }
                case 12 : {
                    $line[12] += 1;
                    break;
                }
            }
        }

        $query = Category::find()
            ->select(["category.id", "color", "category.name"])
            ->joinWith("accountings")
            ->asArray()
            ->all();

        $doughnut = $query;

        $query = $modelClass::find()->all();

        foreach ($query as $item) {
            $hour = date('H', $item->dates);
            if (array_key_exists($hour, $bar)){
                $bar[$hour] += 1;
            }
        }

        $response = [
            'doughnut'  => $doughnut,
            'bar'       => $bar,
            'line'      => $line
        ];

        return $response;
    }
}

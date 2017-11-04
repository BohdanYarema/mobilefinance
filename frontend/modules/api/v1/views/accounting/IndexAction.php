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
            1 => [
                'name'  => 'January',
                'count' => 0
            ],
            2 => [
                'name'  => 'Febuary',
                'count' => 0
            ],
            3 => [
                'name'  => 'March',
                'count' => 0
            ],
            4 => [
                'name'  => 'April',
                'count' => 0
            ],
            5 => [
                'name'  => 'May',
                'count' => 0
            ],
            6 => [
                'name'  => 'June',
                'count' => 0
            ],
            7 => [
                'name'  => 'July',
                'count' => 0
            ],
            8 => [
                'name'  => 'August',
                'count' => 0
            ],
            9 => [
                'name'  => 'September',
                'count' => 0
            ],
            10 => [
                'name'  => 'October',
                'count' => 0
            ],
            11 => [
                'name'  => 'November',
                'count' => 0
            ],
            12 => [
                'name'  => 'December',
                'count' => 0
            ],
        ];

        $bar = [];
        $doughnut = [];

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->where(['user_id' => Yii::$app->user->id])->all();

        foreach ($query as $item) {
            $mounth = date('m', $item->dates);
            switch ($mounth){
                case 1 : {
                    $line[1]['count'] += 1;
                    break;
                }
                case 2 : {
                    $line[2]['count']  += 1;
                    break;
                }
                case 3 : {
                    $line[3]['count']  += 1;
                    break;
                }
                case 4 : {
                    $line[4]['count']  += 1;
                    break;
                }
                case 5 : {
                    $line[5]['count']  += 1;
                    break;
                }
                case 6 : {
                    $line[6]['count']  += 1;
                    break;
                }
                case 7 : {
                    $line[7]['count']  += 1;
                    break;
                }
                case 8 : {
                    $line[8]['count']  += 1;
                    break;
                }
                case 9 : {
                    $line[9]['count']  += 1;
                    break;
                }
                case 10 : {
                    $line[10]['count']  += 1;
                    break;
                }
                case 11 : {
                    $line[11]['count']  += 1;
                    break;
                }
                case 12 : {
                    $line[12]['count']  += 1;
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

        $query = Category::find()
            ->select(["id", "color", "name"])
            ->asArray()
            ->all();

        foreach ($query as $item) {

            $subquery = Accounting::find()
                ->select(['Count(id) as stats', "dates"])
                ->groupBy("dates")
                ->where(['category_id' => $item['id']])
                ->andWhere(['user_id' => Yii::$app->user->id])
                ->orderBy(['stats' => SORT_DESC])
                ->asArray()
                ->one();

            $hour = date('H', $subquery['dates']);
            $bar[] = [
                'category'  => $item,
                'hour'      => $hour,
                'count'     => $subquery['stats']
            ];
        }

        $response = [
            'doughnut'  => $doughnut,
            'bar'       => $bar,
            'line'      => $line
        ];

        return $response;
    }
}

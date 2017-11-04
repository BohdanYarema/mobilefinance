<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\api\v1\views\accounting;

use frontend\modules\api\v1\models\Accounting;
use Yii;
use yii\rest\Action;

class MapAction extends Action
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

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass Accounting */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()
            ->select(['gps_x', 'gps_y', "Count(id)"])
            ->groupBy(['gps_x', 'gps_y'])
            ->andWhere(['not', ['gps_x' => null]])
            ->andWhere(['not', ['gps_y' => null]])
            ->andWhere(['not', ['gps_x' => 0]])
            ->andWhere(['not', ['gps_y' => 0]])
            ->asArray()
            ->all();

        $response = $query;

        return $response;
    }
}

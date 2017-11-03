<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\api\v1\views\accounting;

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

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $forday = $modelClass::find()
            ->select([
                'COUNT(id) as result',
                "dates",
            ])
            ->groupBy('dates')
            ->asArray()
            ->all();

        $forcategory = $modelClass::find()
            ->select([
                'COUNT(id) as result',
                "category_id",
            ])
            ->groupBy('category_id')
            ->asArray()
            ->all();

        $response = [
            'perday'        => $forday,
            'percategory'   => $forcategory
        ];

        return json_encode($response);
    }
}

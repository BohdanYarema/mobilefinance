<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\api\v1\views\accounting;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class LastAction extends Action
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

        $dataProvider = Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $modelClass::find()
                ->andWhere(['user_id' => Yii::$app->user->id])
                ->limit(4)
                ->orderBy(['dates' => SORT_DESC]),
            'pagination' => false,
        ]);

        foreach($dataProvider->getModels() as $model):
            $response[] = [
                'id'            => $model->id,
                'category_id'   => $model->category_id,
                'thumbnail'     => $model->thumbnail,
                'price'         => $model->price,
                'dates'         => date('d-m-Y', $model->dates),
                'name'          => $model->name,
                'type'          => $model->type,
                'gps_x'         => $model->gps_x,
                'gps_y'         => $model->gps_y,
                'tags'          => $model->tags,
            ];
        endforeach;

        return $response;
    }
}

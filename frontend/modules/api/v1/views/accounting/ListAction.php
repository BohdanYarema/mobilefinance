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

class ListAction extends Action
{
    public $prepareDataProvider;


    /**
     * @return array
     * @var $id integer
     */
    public function run($id)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        echo json_encode($this->prepareDataProvider($id));
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array
     * @var $id integer
     */
    protected function prepareDataProvider($id)
    {
        $response = [];

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $dataProvider = $modelClass::find()
                ->where(['category_id' => $id, 'user_id' => Yii::$app->user->id])
                ->orderBy(['dates' => SORT_DESC])->all();

        foreach($dataProvider as $model):
            if($model->type == 0 || $model->type === null){
                $type = false;
            } else {
                $type = true;
            }
            $response[] = [
                'id'            => $model->id,
                'category_id'   => $model->category_id,
                'price'         => $model->price,
                'dates'         => date('d-m-Y', $model->dates),
                'name'          => $model->name,
                'gps_x'         => $model->gps_x,
                'gps_y'         => $model->gps_y,
                'tags'          => $model->tags,
                'type'          => $type,
                'thumbnail'     => $model->thumbnail,
            ];
        endforeach;
        return $response;
    }
}

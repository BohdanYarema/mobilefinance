<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\rest\accounting;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

/**
 * IndexAction implements the API endpoint for listing multiple models.
 *
 * For more details and usage information on IndexAction, see the [guide article on rest controllers](guide:rest-controllers).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAction extends Action
{
    /**
     * @var callable a PHP callable that will be called to prepare a data provider that
     * should return a collection of the models. If not set, [[prepareDataProvider()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($action) {
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return an instance of [[ActiveDataProvider]].
     */
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

        $dataProvider = Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $modelClass::find()
                ->where(['category_id' => $id])
            ->orderBy(['dates' => SORT_ASC]),
            'pagination' => false,
        ]);

        foreach($dataProvider->getModels() as $model):
            if(!isset($date) || $date != Yii::$app->formatter->asDate($model->dates)):
                $date = Yii::$app->formatter->asDate($model->dates);
                $response[$model->dates] = [
                    'id'            => $model->id,
                    'category_id'   => $model->category_id,
                    'price'         => $model->price,
                    'dates'         => $model->dates,
                    'tags'          => $model->tags
                ];
            endif;
        endforeach;

        return $response;
    }
}

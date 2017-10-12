<?php

namespace backend\controllers;

use common\models\Accounting;
use common\models\Tags;
use Yii;
use common\models\TagToAccounting;
use backend\models\search\TagToAccountingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagrelationController implements the CRUD actions for TagToAccounting model.
 */
class TagrelationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TagToAccounting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagToAccountingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TagToAccounting model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model      = new TagToAccounting();
        $accounting = Accounting::find()->all();
        $tags       = Tags::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body'=>\Yii::t('backend', 'Settings was successfully saved'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model'         => $model,
                'accounting'    => $accounting,
                'tags'          => $tags
            ]);
        }
    }

    /**
     * Updates an existing TagToAccounting model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model      = $this->findModel($id);
        $accounting = Accounting::find()->all();
        $tags       = Tags::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body'=>\Yii::t('backend', 'Settings was successfully saved'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'         => $model,
                'accounting'    => $accounting,
                'tags'          => $tags
            ]);
        }
    }

    /**
     * Deletes an existing TagToAccounting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TagToAccounting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TagToAccounting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TagToAccounting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

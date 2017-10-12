<?php

namespace backend\controllers;

use common\models\Category;
use Yii;
use common\models\Accounting;
use backend\models\search\AccountingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountingController implements the CRUD actions for Accounting model.
 */
class AccountingController extends Controller
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
     * Lists all Accounting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Accounting model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model      = new Accounting();
        $categories = Category::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body'=>\Yii::t('backend', 'Settings was successfully saved'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model'         => $model,
                'categories'    => $categories
            ]);
        }
    }

    /**
     * Updates an existing Accounting model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model      = $this->findModel($id);
        $categories = Category::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body'=>\Yii::t('backend', 'Settings was successfully saved'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'         => $model,
                'categories'    => $categories
            ]);
        }
    }

    /**
     * Deletes an existing Accounting model.
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
     * Finds the Accounting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accounting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accounting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

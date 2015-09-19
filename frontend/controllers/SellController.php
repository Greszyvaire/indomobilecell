<?php

namespace frontend\controllers;

use Yii;
use common\models\Sell;
use common\models\SellInfo;
use common\models\SellDet;
use common\models\SellSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SellController implements the CRUD actions for Sell model.
 */
class SellController extends Controller {

    public function behaviors() {
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
     * Lists all Sell models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SellSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sell model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $modelDet = SellDet::find()->where(['sell_id'=>$id])->all();
        $modelInfo = SellInfo::findOne(['sell_id'=>$id]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelDet'=>$modelDet,
                    'modelInfo'=>$modelInfo
        ]);
    }

    /**
     * Creates a new Sell model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Sell();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sell model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sell model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sell model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sell the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Sell::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionOrder(){
        $pesanan = Sell::find()->with(['info'])->where(['customer_user_id' => 65]);
        $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $pesanan->count(),
            ]);
        $pesanan = $pesanan->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('order',['pesanan'=>$pesanan,'pagination'=>$pagination]);
    }

}

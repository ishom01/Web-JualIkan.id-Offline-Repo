<?php

namespace frontend\controllers;

use Yii;
use common\models\KoperasiPinjaman;
use backend\models\KoperasiPinjamanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\UserKoperasi;
use common\models\UserNelayan;
use yii\data\ActiveDataProvider;

/**
 * KoperasiPinjamanController implements the CRUD actions for KoperasiPinjaman model.
 */
class KoperasiPinjamanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all KoperasiPinjaman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KoperasiPinjamanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexbulan()
    {

        $month = Date('m');
        $last  = date('t');

        $firstDate = Date('Y-'. $month . '-1');
        $lastDate = Date('Y-'. $month . '-' . $last);

        $query = KoperasiPinjaman::find()->where(['between', 'pinjaman_date', $firstDate, $lastDate]);
        $count = $query->count();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new KoperasiPinjamanSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single KoperasiPinjaman model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new KoperasiPinjaman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KoperasiPinjaman();

        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();

        if ($model->load(Yii::$app->request->post())) {

            $nelayan = UserNelayan::find()->where(['nelayan_id' => $model->pinjaman_nelayan_id])->one();
            $nelayan->nelayan_saldo = ($nelayan->nelayan_saldo) - ($model->pinjaman_jumlah);

            $model->pinjaman_koperasi_id = $object->koperasi_id;
            if ($model->save() && $nelayan->save()) {
                return $this->redirect(['view', 'id' => $model->pinjaman_id]);
            }else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KoperasiPinjaman model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pinjaman_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KoperasiPinjaman model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KoperasiPinjaman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KoperasiPinjaman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KoperasiPinjaman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

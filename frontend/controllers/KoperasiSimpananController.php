<?php

namespace frontend\controllers;

use Yii;
use common\models\KoperasiSimpanan;
use backend\models\KoperasiSimpananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\UserKoperasi;
use common\models\UserNelayan;
use yii\data\ActiveDataProvider;
/**
 * KoperasiSimpananController implements the CRUD actions for KoperasiSimpanan model.
 */
class KoperasiSimpananController extends Controller
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
     * Lists all KoperasiSimpanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KoperasiSimpananSearch();
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

        $query = KoperasiSimpanan::find()->where(['between', 'simpanan_date', $firstDate, $lastDate]);
        $count = count($query);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new KoperasiSimpananSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single KoperasiSimpanan model.
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
     * Creates a new KoperasiSimpanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KoperasiSimpanan();

        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->simpanan_koperasi_id = $object->koperasi_id;

            $nelayan = UserNelayan::find()->where(['nelayan_id' => $model->simpanan_nelayan_id])->one();
            $nelayan->nelayan_saldo = ($nelayan->nelayan_saldo) + ($model->simpanan_jumlah);

            if ($model->save() && $nelayan->save()) {
                return $this->redirect(['view', 'id' => $model->simpanan_id]);
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
     * Updates an existing KoperasiSimpanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->simpanan_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KoperasiSimpanan model.
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
     * Finds the KoperasiSimpanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KoperasiSimpanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KoperasiSimpanan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

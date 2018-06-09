<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Delivery;
use frontend\models\DeliverySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\data\SqlDataProvider;
use backend\models\UserKoperasi;

/**
 * DeliveryController implements the CRUD actions for Delivery model.
 */
class DeliveryController extends Controller
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
     * Lists all Delivery models.
     * @return mixed
     */
    public function actionIndex()
    {

        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $idkoperasi = $object['koperasi_id'];

        date_default_timezone_set('Asia/Jakarta');
        $date = Date('Y-m-d');
        $query = new Query;
        $query
              ->from('`delivery` c')
              ->andWhere(['c.delivery_order_koperasi_id' => $idkoperasi])
              ->orderBy(['c.delivery_time_depart' => SORT_DESC]);

        $count = $query->count();

        // $query = Fish::find()->limit(10)->orderBy(['fish_id' => SORT_DESC]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    public function actionHariini()
    {

        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $idkoperasi = $object['koperasi_id'];

        date_default_timezone_set('Asia/Jakarta');
        $date = Date('Y-m-d');
        $query = new Query;
        $query
              ->from('`delivery`')
              ->andWhere(['delivery_order_koperasi_id' => $idkoperasi])
              ->andFilterWhere(['like', 'delivery_time_depart',$date])
              ->orderBy(['delivery_time_depart' => SORT_ASC]);

        $total = $query->count();

        // $query = Fish::find()->limit(10)->orderBy(['fish_id' => SORT_DESC]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $total,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('hariini', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    public function actionBulanini()
    {
        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $idkoperasi = $object['koperasi_id'];

        $month = Date('m');
        $last  = date('t');

        $firstDate = Date('Y-'. $month . '-01');
        $lastDate = Date('Y-'. $month . '-' . $last);

        $query = Delivery::find()->where(['between', 'delivery_time_depart', $firstDate, $lastDate])->andWhere(['delivery_order_koperasi_id' => $idkoperasi])->orderBy(['delivery_time_depart' => SORT_DESC]);
        $total = $query->count();
        $count = count($query);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $total,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bulanini', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single Delivery model.
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
     * Creates a new Delivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Delivery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->delivery_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Delivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->delivery_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Delivery model.
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
     * Finds the Delivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Delivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Delivery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

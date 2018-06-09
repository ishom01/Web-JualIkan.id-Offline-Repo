<?php

namespace frontend\controllers;

use Yii;
use common\models\Order;
use frontend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\data\SqlDataProvider;
use backend\models\UserKoperasi;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
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
              ->from('`order` c')
              ->andWhere(['c.order_koperasi_location_id' => $idkoperasi])
              ->orderBy(['c.order_date' => SORT_DESC]);

        $count = $query->count();

        // $query = Fish::find()->limit(10)->orderBy(['fish_id' => SORT_DESC]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        $searchModel = new OrderSearch();
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
              ->from('`order`')
              ->andWhere(['order_koperasi_location_id' => $idkoperasi])
              ->andFilterWhere(['like', 'order_date',$date])
              ->orderBy(['order_date' => SORT_ASC]);

        $query2 = new Query;
        $query2
              ->from('`order`')
              ->andWhere(['order_koperasi_location_id' => $idkoperasi])
              ->andFilterWhere(['like', 'order_date',$date])
              ->andWhere(['order_status' => 1])
              ->orderBy(['order_date' => SORT_DESC]);

        $total2 = $query2->count();

        $total = $query->count();

        // $query = Fish::find()->limit(10)->orderBy(['fish_id' => SORT_DESC]);
        $count = count($query);
        // echo json_encode($query);
        // echo $count;

        $newProvider = new SqlDataProvider([
          'sql' => "SELECT * FROM `order`",
          'totalCount' => $total,
          'pagination' => [
              'pageSize' => 20,
          ],
        ]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $total,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('hariini', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider ,
            'jumlah' => $total2,
        ]);
    }

    public function actionBulanini()
    {

        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $idkoperasi = $object['koperasi_id'];

        $month = Date('m');
        $last  = date('t');

        $firstDate = Date('Y-'. $month . '-1');
        $lastDate = Date('Y-'. $month . '-' . $last);

        $query = Order::find()
          ->where(['between', 'order_date', $firstDate, $lastDate])
          ->andWhere(['order_koperasi_location_id' => $idkoperasi])
          ->orderBy(['order_date' => SORT_DESC]);
        $total = $query->count();
        $count = count($query);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $total,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new OrderSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bulanini', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single Order model.
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

    public function actionGenerate()
    {
        $model = Order::find()->All();
        return $this->render('generate', [
            'model' => $model,
        ]);
    }

    public function actionFinish()
    {
        $model = Order::find()->All();
        return $this->render('finish', [
            'model' => $model,
        ]);
    }

    public function actionGenerate2()
    {
        $model = Order::find()->All();
        return $this->render('generate2', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionVerifikasipembayaran($id){
        $model = $this->findModel($id);
        $model->order_status = 1;
        if ($model->save()) {
          return $this->redirect(['hariini']);
        }else {
            return $this->redirect(['hariini']);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

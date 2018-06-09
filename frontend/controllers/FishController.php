<?php

namespace frontend\controllers;

use Yii;
use backend\models\Fish;
use frontend\models\FishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\UserKoperasi;
use yii\web\UploadedFile;

use yii\data\ActiveDataProvider;
use yii\db\Query;


/**
 * FishController implements the CRUD actions for Fish model.
 */
class FishController extends Controller
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
     * Lists all Fish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTerlaris()
    {
        $searchModel = new FishSearch();

        $query = new Query;
        $query->select(['f.fish_id as fish_id', 'f.fish_price as fish_price', 'f.fish_koperasi_id as fish_koperasi_id', 'f.fish_name as fish_name', 'f.fish_image as fish_image', 'SUM(c.cart_fish_qty) as fish_qty'])
              ->from('cart c')
              ->join('LEFT JOIN', 'fish f', 'f.fish_id = c.cart_fish_id')
              ->where(['c.cart_status' => 1])
              ->limit(10)
              ->groupBy('c.cart_fish_id', 'c.cart_fish_qty')
              ->orderBy(['c.cart_fish_qty' => SORT_DESC]);

        // $query = Fish::find()->limit(10)->orderBy(['fish_id' => SORT_DESC]);
        $count = count($query);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('terlaris', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single Fish model.
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
     * Creates a new Fish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fish();
        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $model->fish_koperasi_id = $object->koperasi_id;

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'fish_image');
            $model->fish_image = 'img/' . $image->baseName. '.' . $image->extension;
            $image->saveAs($model->fish_image);
            $model->save();
            return $this->redirect(['view', 'id' => $model->fish_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $model->fish_koperasi_id = $object->koperasi_id;

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'fish_image');
            $model->fish_image = 'img/' . $image->baseName. '.' . $image->extension;
            $image->saveAs($model->fish_image);
            $model->save();
            return $this->redirect(['view', 'id' => $model->fish_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fish model.
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
     * Finds the Fish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fish::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

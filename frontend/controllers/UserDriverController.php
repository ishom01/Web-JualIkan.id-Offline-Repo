<?php

namespace frontend\controllers;

use Yii;
use common\models\UserDriver;
use frontend\models\UserDriverSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\models\UserKoperasi;
use yii\web\UploadedFile;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\data\SqlDataProvider;

/**
 * UserDriverController implements the CRUD actions for UserDriver model.
 */
class UserDriverController extends Controller
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
     * Lists all UserDriver models.
     * @return mixed
     */
    public function actionIndex()
    {
        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $idkoperasi = $object['koperasi_id'];

        $query = new Query;
        $query
              ->from('user_driver')
              ->andWhere(['driver_koperasi_id' => $idkoperasi]);
        $total = $query->count();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $total,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $searchModel = new UserDriverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single UserDriver model.
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
     * Creates a new UserDriver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserDriver();
        $koperasi = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->driver_koperasi_id = $koperasi->koperasi_id;
            $image = UploadedFile::getInstance($model, 'driver_image');
            if ($image == null) {
                $model->driver_image = "frontend/web/img/user_default.png";
            }else {
                $model->driver_image = 'img/' . $image->baseName. '.' . $image->extension;
                $image->saveAs($model->driver_image);
                $model->driver_image = "frontend/web/" . $model->driver_image;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->driver_id]);
            }else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserDriver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->driver_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserDriver model.
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
     * Finds the UserDriver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDriver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDriver::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

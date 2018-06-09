<?php

namespace backend\controllers;

use Yii;
use backend\models\UserKoperasi;
use backend\models\UserKoperasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\User;


/**
 * UserKoperasiController implements the CRUD actions for UserKoperasi model.
 */
class UserKoperasiController extends Controller
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
     * Lists all UserKoperasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserKoperasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBaru()
    {
        $query = UserKoperasi::find()->where(['koperasi_status' => 0]);
        $count = count($query);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // echo count($query);

        return $this->render('baru', [
            // 'searchModel' => $searchModel,
            // 'model' => $this->findModel($id),
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single UserKoperasi model.
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
     * Creates a new UserKoperasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserKoperasi();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->kopreasi_image == null) {
                $model->kopreasi_image = 'frontend/web/img/icon-koperasi.png';
            }
            $model->koperasi_password = $this->generateRandomString();
            $model->koperasi_status = 1;

            //create akun koperasi_id
            $user = new User();
            $user->username = $model->koperasi_email;
            $user->email = $model->koperasi_email;
            $user->setPassword($model->koperasi_password);
            $user->generateAuthKey();
            //simpan akun
            $user->save();

            //kirim akun ke sms
            $message = "Selamat akun koperasi anda berhasil diverivikasi oleh admin!%0a";
            $message .= "Berikut informasi akun anda :%0a";
            $message .= "Email    : ". $model->koperasi_email . "%0a";
            $message .= "Password : ". $model->koperasi_password . "%0a";

            // $message = nl2br($message);

            $data = "msisdn=". $model->koperasi_holder_phone ."&content=" .$message;

            echo $data;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.mainapi.net/smsnotification/1.0.0/messages");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer 5d766c57aa881a778b08cb42f75df1fb',
                'Accept: application/json')
            );
            $result = curl_exec($ch);

            echo $result;

            $model->save();
            return $this->redirect(['view', 'id' => $model->koperasi_id]);

            // kirim email

        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserKoperasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->koperasi_status == 0) {
                $model->koperasi_lat = "";
                $model->koperasi_lng = "";
                $model->koperasi_level_id = 0;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->koperasi_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionVerifikasi($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->kopreasi_image == null) {
                $model->kopreasi_image = 'frontend/web/img/icon-koperasi.png';
            }
            $model->koperasi_password = $this->generateRandomString();
            $model->koperasi_status = 1;

            //create akun koperasi_id
            $user = new User();
            $user->username = $model->koperasi_email;
            $user->email = $model->koperasi_email;
            $user->setPassword($model->koperasi_password);
            $user->generateAuthKey();
            //simpan akun
            $user->save();

            //kirim akun ke sms
            $message = "Selamat akun koperasi anda berhasil diverivikasi oleh admin!%0a";
            $message .= "Berikut informasi akun anda :%0a";
            $message .= "Email    : ". $model->koperasi_email . "%0a";
            $message .= "Password : ". $model->koperasi_password . "%0a";

            // $message = nl2br($message);

            $data = "msisdn=". $model->koperasi_holder_phone ."&content=" .$message;

            echo $data;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.mainapi.net/smsnotification/1.0.0/messages");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer 102d8310b9f5f86aaa3b3000fa22e5b4',
                'Accept: application/json')
            );
            $result = curl_exec($ch);

            echo $result;

            $model->save();
            return $this->redirect(['view', 'id' => $model->koperasi_id]);

            // kirim email

        }else {
            return $this->render('verifikasi', [
                'model' => $model,
            ]);
        }


    }

    protected function generateRandomString() {
        $length = 12;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function actionUnverifikasi($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing UserKoperasi model.
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
     * Finds the UserKoperasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserKoperasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserKoperasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

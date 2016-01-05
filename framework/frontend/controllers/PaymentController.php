<?php

namespace frontend\controllers;

use Yii;
use common\models\Payment;
use common\models\Sell;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller {

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
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Payment::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $this->layout = 'mainSingle';
        Yii::error($_GET['id']);
        $model = new Payment();
        if (isset($_POST['Payment'])) {
            $model->attributes = $_POST['Payment'];
        }
        $sell = Sell::findOne($_GET['id']);
        if (isset($_POST['Payment']['self_name'])) {
            $sellM = Sell::findOne($_GET['id']);
            $sellM->is_confirm = 1;
            $sellM->save();
            // send email to info@indomobilecell.com
            //send email
//            $user = User::findOne(Yii::$app->user->identity->id);
//            $sell = Sell::findOne($_GET['id']);
//            Yii::$app->mail->compose('pembelian', ['sell_id' => $_GET['id'], 'sell' => $sell])
//                    ->setFrom(['noreply@indomobilecell.com' => 'Indomobilecell Malang'])
//                    ->setTo($user->email)
//                    ->setSubject('Konfirmasi Pembayaran #' . $sell->code . ' | INDOMOBILECELL ')
//                    ->send();

//            $subjec = 'KONFIRMASI PEMBAYARAN INVOICE #' . $sell->code;
////                    $content = 'Klik <a href="' . Yii::$app->urlManager->createUrl('reset-password/' . md5($user->id)) . '">disini</a> unruk melakukan reset password';
//            $from = "info@indomobilecell.com";
//            $to = "info@indomobilecell.com";
//
//            $content = '<table border="0" cellpadding="0" cellspacing="0" style="font-size: 13px" width="650px">
//                    <tbody>
//                            <tr>
//                                    <td style="text-align: center">
//                                    <div style="background-color:#e1ecf9;margin: 3px;border:1px solid #bfd7ff;width: 642;padding: 10px 0;">
//                                    <h2 style="margin: 0px">INDOMOBILECELL MALANG</h2>
//                                    <em style="font-size:11px">Jl. Brigjend S.Riadi 10, kota malang, jawa timur. (0341) 355 333 - Mail : info@indomobilecell.com</em><br />
//                                    <br />
//                                    <b>INVOICE #' . $sell->code . '</b></div>
//
//                                    <table style="font-size: 13px" width="650px">
//                                            <tbody>
//                                                    <tr valign="top">
//                                                            <td width="50%">
//                                                            <table cellpadding="4" style="font-size: 13px" width="100%">
//                                                                    <tbody>
//                                                                           
//                                                                            <tr valign="top">
//                                                                                    <td style="text-align: left;">Atas Nama</td>
//                                                                                    <td style="text-align: left;">:</td>
//                                                                                    <td style="text-align: left;">' . $_POST['Payment']['self_name'] . '</td>
//                                                                            </tr>
//                                                                            <tr valign="top">
//                                                                                    <td style="text-align: left;">No Rekening</td>
//                                                                                    <td style="text-align: left;">:</td>
//                                                                                    <td style="text-align: left;">' . $_POST['Payment']['self_account_number'] . '</td>
//                                                                            </tr>
//                                                                    </tbody>
//                                                            </table>
//                                                            </td>
//                                                            <td width="50%">
//                                                            <table cellpadding="4" style="font-size: 13px" width="100%">
//                                                                    <tbody>
//                                                                            
//                                                                            <tr valign="top">
//                                                                                    <td style="text-align: left;">Jumlah Transfer</td>
//                                                                                    <td style="text-align: left;">:</td>
//                                                                                    <td style="text-align: left;">' . Yii::$app->landa->rp($_POST['Payment']['amount']) . '</td>
//                                                                            </tr>
//                                                                            <tr valign="top">
//                                                                                    <td style="text-align: left;">Keterangan</td>
//                                                                                    <td style="text-align: left;">:</td>
//                                                                                    <td style="text-align: left;">' . $_POST['Payment']['description'] . '</td>
//                                                                            </tr>
//                                                                    </tbody>
//                                                            </table>
//                                                            </td>
//                                                    </tr>
//                                                    <tr>
//                                                    <td colspan="2">
//                                                    <div style="background-color:#e1ecf9;margin:3px;border:1px solid #bfd7ff;width:642;padding:10px 0">
//                                                    SEKIAN TERIMAKASIH
//                                    </div>
//                                                    </td>
//                                                    </tr>
//                                            </tbody>
//                                    </table>
//                   
//
//                                    &nbsp;</div>
//                                    </div>
//                                    </td>
//                            </tr>
//                    </tbody>
//            </table>
//
//            <div style="border-top:1px solid #ccc;margin:15px 2px 0px 2px;width: 650px; line-height:10px">&nbsp;</div>';
////            $name = '=?UTF-8?B?' . base64_encode($email) . '?=';
//            $subject = '=?UTF-8?B?' . base64_encode($subjec) . '?=';
//            $headers = "From: Konfirmasi pembayaran <{info@indomobilecell.com}>\r\n" .
//                    "Reply-To: {$from}\r\n" .
//                    "MIME-Version: 1.0\r\n" .
//                    "Content-type: text/html; charset: utf8\r\n";
//
//            mail($to, $subject, $content, $headers);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->urlManager->createUrl('detail-pesanan/' . $sell->id));
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'sell' => $sell
            ]);
        }
    }

    /**
     * Updates an existing Payment model.
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
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

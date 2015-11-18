<?php

namespace frontend\controllers;

use Yii;
use common\models\Sell;
use common\models\SellDet;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class AppsellController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'update' => ['post'],
                    'delete' => ['delete'],
                ],
            ]
        ];
    }

    public function beforeAction($event) {
        $action = $event->id;
        if (isset($this->actions[$action])) {
            $verbs = $this->actions[$action];
        } elseif (excel(isset($this->actions['*']))) {
            $verbs = $this->actions['*'];
        } else {
            return $event->isValid;
        }
        $verb = Yii::$app->getRequest()->getMethod();
        $allowed = array_map('strtoupper', $verbs);
//        Yii::error($allowed);

        if (!in_array($verb, $allowed)) {

            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'message' => 'Method not allowed'), JSON_PRETTY_PRINT);
            exit;
        }

        return true;
    }

    public function actionIndex() {
        //init variable
        $params = $_REQUEST;
        $filter = array();
        $sort = "sell.id DESC";
        $offset = 0;
        $limit = 10;
        //        Yii::error($params);
        //limit & offset pagination
        if (isset($params['limit']))
            $limit = $params['limit'];
        if (isset($params['offset']))
            $offset = $params['offset'];

        //sorting
        if (isset($params['sort'])) {
            $sort = $params['sort'];
            if (isset($params['order'])) {
                if ($params['order'] == "false")
                    $sort.=" ASC";
                else
                    $sort.=" DESC";
            }
        }

        //create query
        $query = new Query;
        $query->offset($offset)
                ->limit($limit)
                ->from('sell')
                ->join('left join', 'sell_info', 'sell.id = sell_info.sell_id')
                ->join('left join', 'user', 'sell.customer_user_id = user.id')
//                ->join('left join', 'city', 'sell_info.city_id = city.id')
//                ->join('left join', 'province', 'city.province_id = province.id')
                ->orderBy($sort)
                ->select("sell.*, sell_info.status,user.name");

        //filter
        if (isset($params['filter'])) {
            $filter = (array) json_decode($params['filter']);
            foreach ($filter as $key => $val) {
                $query->andFilterWhere(['like', $key, $val]);
            }
        }

        $command = $query->createCommand();
        $models = $command->queryAll();
        $totalItems = $query->count();


        $data = array();
        $i = 0;
        foreach ($models as $val) {
            $data[$i] = $val;
            if ($val['is_confirm'] == "1") {
                $data[$i]['bayar'] = "Terbayar";
            } else {
                $data[$i]['bayar'] = "Belum Terbayar";
            }
            if ($val['is_asuransi'] == "1") {
                $data[$i]['asuransi'] = "Asuransi";
            } else {
                $data[$i]['asuransi'] = "Tanpa Asuransi";
            }
            $i++;
        }

        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'data' => $data, 'totalItems' => $totalItems), JSON_PRETTY_PRINT);
    }

    public function actionView($id) {

        $model = $this->findModel($id);
//        $data = $model->attributes;
        $query = new Query;
        $query->from('sell')
                ->join('left join', 'sell_info', 'sell.id = sell_info.sell_id')
                ->join('left join', 'user', 'sell.customer_user_id = user.id')
                ->join('left join', 'city', 'sell_info.city_id = city.id')
                ->join('left join', 'province', 'city.province_id = province.id')
                ->where('sell.id="'.$model['id'].'"')
                ->select("sell.*, sell_info.name,sell_info.sell_id,sell_info.status,sell_info.address,sell_info.phone,sell_info.postcode, user.name,city.name as city, province.name as province");
        $command = $query->createCommand();
          $models = $command->query()->read();
        // DETAIL

        $det = SellDet::find()
                ->with(['product'])
                ->orderBy('id')
                ->where(['sell_id' => $model['id']])
                ->all();


        $detail = array();

        foreach ($det as $key => $val) {
            $detail[$key] = $val->attributes;

            $namaBarang = (isset($val->product->name)) ? $val->product->name : '';
            $hargaBarang = (isset($val->product->price_sell)) ? $val->product->price_sell : '';

            $detail[$key]['produk'] = [ 'nama' => $namaBarang, 'harga' => $hargaBarang];
        }

        $this->setHeader(200);
        echo json_encode(array('status' => 1, 'data' => $models, 'detail' => $detail), JSON_PRETTY_PRINT);
    }

    public function actionUpdate($id) {
        $params = json_decode(file_get_contents("php://input"), true);
        \Yii::error($params);
        $model = $this->findModel($id);
        $model->attributes = $params;
        
        $det = \common\models\SellInfo::find()
                ->where(['sell_id' => $model['id']])->one();
        $det->status = $params['status'];
        $det->save();

        if ($model->save()) {
            $this->setHeader(200);
            echo json_encode(array('status' => 1, 'data' => array_filter($model->attributes)), JSON_PRETTY_PRINT);
        } else {
            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $model->errors), JSON_PRETTY_PRINT);
        }
    }

    public function actionDelete($id) {
        Yii::error($id);
        $model = $this->findModel($id);
        $deleteDetail = SellDet::deleteAll(['sell_id' => $id]);
        $deleteDetailinfo = \common\models\SellInfo::deleteAll(['sell_id' => $id]);

        if ($model->delete()) {
            $this->setHeader(200);
            echo json_encode(array('status' => 1, 'data' => array_filter($model->attributes)), JSON_PRETTY_PRINT);
        } else {

            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $model->errors), JSON_PRETTY_PRINT);
        }
    }

    protected function findModel($id) {
        if (($model = Sell::findOne($id)) !== null) {
            return $model;
        } else {

            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'message' => 'Bad request'), JSON_PRETTY_PRINT);
            exit;
        }
    }

    private function setHeader($status) {

        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        $content_type = "application/json; charset=utf-8";

        header($status_header);
        header('Content-type: ' . $content_type);
        header('X-Powered-By: ' . "Nintriva <nintriva.com>");
    }

    private function _getStatusCodeMessage($status) {
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}

?>

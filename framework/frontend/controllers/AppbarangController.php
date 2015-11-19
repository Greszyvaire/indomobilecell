<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductPhoto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class AppbarangController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'cari' => ['get'],
                    'caribrand' => ['get'],
                    'catsrc' => ['get'],
                    'satlist' => ['get'],
                    'pid' => ['get'],
                    'create' => ['post'],
                    'update' => ['post'],
                    'delete' => ['delete'],
                    'upload' => ['post'],
                    'removegambar' => ['post'],
                    'updatedetail' => ['post'],
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


        if (!in_array($verb, $allowed)) {

            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'message' => 'Method not allowed'), JSON_PRETTY_PRINT);
            exit;
        }

        return true;
    }

    public function actionSatlist() {
        $query = new Query;
        $query->from('product_measure')
                ->select('*');

        $command = $query->createCommand();
        $models = $command->queryAll();

        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'satuan' => $models));
    }

    public function actionCari() {

        $params = $_REQUEST;
        $query = new Query;
        $query->from('product')
                ->select("product.*")
                ->andWhere(['like', 'product.name', $params['nama']]);

        $command = $query->createCommand();
        $models = $command->queryAll();

        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'data' => $models));
    }

    public function actionCatsrc() {

        $params = $_REQUEST;
        $query = new Query;
        $query->from('product_category')
                ->select("*")
                ->andWhere(['like', 'name', $params['nama']]);

        $command = $query->createCommand();
        $models = $command->queryAll();

        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'data' => $models));
    }

    public function actionCaribrand() {

        $params = $_REQUEST;
        $query = new Query;
        $query->from('product_brand')
                ->select("product_brand.*")
                ->andWhere(['like', 'product_brand.name', $params['nama']]);

        $command = $query->createCommand();
        $models = $command->queryAll();

        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'data' => $models));
    }

    public function actionIndex() {
        //init variable
        $params = $_REQUEST;
        $filter = array();
        $sort = "product.name ASC";
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
                ->from('product')
                ->orderBy($sort)
                ->select("product.*");

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


        foreach ($models as $key => $val) {

            $cat = \common\models\ProductCategory::findOne($val['product_category_id']);
            $sat = \common\models\Satuan::findOne($val['product_measure_id']);
            $brand = \common\models\ProductBrand::findOne($val['product_brand_id']);
            $foto = json_decode($this->selectFoto($val['id']));

            $models[$key]['listbrand'] = (empty($brand)) ? [] : $brand->attributes;
            $models[$key]['listsatuan'] = (empty($sat)) ? [] : $sat->attributes;
            $models[$key]['listcategory'] = (empty($cat)) ? [] : $cat->attributes;
            $models[$key]['listfoto'] = (empty($foto)) ? [] : $foto;
            $models[$key]['category'] = (empty($cat)) ? [] : $cat->name;
            $models[$key]['satuan'] = (empty($sat)) ? [] : $sat->name;
            $models[$key]['brand'] = (empty($brand)) ? [] : $brand->name;
        }

        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'data' => $models, 'totalItems' => $totalItems), JSON_PRETTY_PRINT);
    }
    
    public function actionTest() {
        $query = new Query;
        $query->from('product_category')
                ->select("id,parent_id");
        $command = $query->createCommand();
        $models = $command->queryAll();
        $totalItems = $query->count();
        $query = [];
        $i = 0;
        foreach ($models as $key => $val) {
            $query[$i] = "UPDATE product_category SET type = '".$created."' WHERE product_category.id = ".$val['id'].";";
        $i++;
            
        }
        $this->setHeader(200);

        echo json_encode(array('status' => 1, 'data' => $query, 'totalItems' => $totalItems), JSON_PRETTY_PRINT);
    }

    public function setPhoto($id) {
        $query = new Query;
        $query->from('product_photo')
                ->orderBy("product_photo.id ASC")
                ->where(['product_id' => $id])
                ->select('id')
                ->limit(1);
        $command = $query->createCommand();
        $models = $command->query()->read();
        return $models['id'];
    }

    public function selectFoto($id) {
        $query = new Query;
        $query->from('product_photo')
                ->where(['product_id' => $id])
                ->select('id,img');
        $command = $query->createCommand();
        $models = $command->queryAll();
        $data = array();
        foreach ($models as $key => $val) {
            $data[$key] = $val;
            $data[$key]['img'] = strtolower(str_replace(' ','-',$val['img']));
        }
        $return = json_encode($data);
        return $return;
    }

    public function setPhotoid() {
        $query = new Query;
        $query->from('product_photo')
                ->orderBy("id DESC")
                ->select('id')
                ->limit(1);
        $command = $query->createCommand();
        $models = $command->query()->read();
        $id = $models['id'] + 1;
        return $id;
    }

    public function actionPid() {
        $id = $this->selectPid();
        echo json_encode(['pid' => $id]);
    }

    public function selectPid() {
        $query = new Query;
        $query->from('product')
                ->orderBy("id DESC")
                ->select('id')
                ->limit(1);
        $command = $query->createCommand();
        $models = $command->query()->read();
        return $models['id'] + 1;
    }

    public function actionView($id) {

        $model = $this->findModel($id);
        $data = $model->attributes;


        $this->setHeader(200);
        echo json_encode(array('status' => 1, 'data' => $data), JSON_PRETTY_PRINT);
    }

    public function actionUpdatedetail() {
        $params = json_decode(file_get_contents("php://input"), true);
        if (isset($params['form']['price_sell']) || isset($params['form']['stock'])) {
            $model = $this->findModel($params['form']['id']);
            ;
            $model->attributes = $params['form'];
            $model->price_sell = isset($params['form']['price_sell']) ? $params['form']['price_sell'] : '0';
            $model->stock = isset($params['form']['stock']) ? $params['form']['stock'] : '0';
            $model->save();

            $this->setHeader(200);
            echo json_encode(array('status' => 1, 'data' => array_filter($model->attributes)), JSON_PRETTY_PRINT);
        }
    }

    public function actionCreate() {
        $params = json_decode(file_get_contents("php://input"), true);
//        Yii::error($params);
        $model = new Product();
        $model->attributes = $params;
        $model->id = $this->selectPid();
        $model->product_category_id = $params['listcategory']['id'];
        $model->product_brand_id = $params['listbrand']['id'];
        $model->type = "inv";
        $model->product_photo_id = $this->setPhoto($model->id);
        $model->alias = Yii::$app->landa->urlParsing($model->name);

        if ($model->save()) {
            $this->setHeader(200);
            echo json_encode(array('status' => 1, 'data' => array_filter($model->attributes)), JSON_PRETTY_PRINT);
        } else {
            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $model->errors), JSON_PRETTY_PRINT);
        }
    }

    public function actionUpload() {
        if (!empty($_FILES)) {
            $tempPath = $_FILES['file']['tmp_name'];
            $newName = \Yii::$app->landa->urlParsing($_FILES['file']['name']);

            $uploadPath = \Yii::$app->params['pathImg'] . $_GET['folder'] . DIRECTORY_SEPARATOR . $newName;

            move_uploaded_file($tempPath, $uploadPath);

            $gid = $this->setPhotoid();

            $a = \Yii::$app->landa->createImg($_GET['folder'] . '/', $newName, $gid, true);

            if ($_POST['id'] == "undefined" || empty($_POST['id'])) {
                $pid = $this->selectPid();
            } else {
                $pid = $_POST['id'];
            }


            $answer = array('answer' => 'File transfer completed', 'img' => $newName, 'id' => $gid);
            if ($answer['answer'] == "File transfer completed") {

                $foto = new ProductPhoto();
                $foto->id = $gid;
                $foto->product_id = $pid;
                $foto->img = $newName;
                $foto->save();
            }

            echo json_encode($answer);
        } else {
            echo 'No files';
        }
    }

    public function actionRemovegambar() {
        $params = json_decode(file_get_contents("php://input"), true);

        $pid = (!empty($params['id'])) ? $params['id'] : $this->selectPid();

        $foto = ProductPhoto::find()->where(['product_id' => $params['id'], 'img' => $params['img']])->one();

        if (!empty($foto)) {
            \Yii::$app->landa->deleteImg('barang/', $foto['id'], $params['img']);
            $foto->delete();
            $this->setHeader(200);
            echo json_encode(['status' => 1, JSON_PRETTY_PRINT]);
        } else {
            $this->setHeader(400);
            echo json_encode(['status' => 0, 'errors' => 'Field Tak Bisa Dihapus', JSON_PRETTY_PRINT]);
        }
    }

    public function actionUpdate($id) {
        $params = json_decode(file_get_contents("php://input"), true);

        $model = $this->findModel($id);
        $model->attributes = $params;
        $model->product_category_id = $params['listcategory']['id'];
        $model->product_brand_id = $params['listbrand']['id'];
        $model->type = "inv";

        if ($model->save()) {
            $this->setHeader(200);
            echo json_encode(array('status' => 1, 'data' => array_filter($model->attributes)), JSON_PRETTY_PRINT);
        } else {
            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $model->errors), JSON_PRETTY_PRINT);
        }
    }

    public function actionDelete($id) {

        $model = $this->findModel($id);

        if ($model->delete()) {
            $this->setHeader(200);
            echo json_encode(array('status' => 1, 'data' => array_filter($model->attributes)), JSON_PRETTY_PRINT);
        } else {

            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $model->errors), JSON_PRETTY_PRINT);
        }
    }

    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
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

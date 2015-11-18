<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ArticleController extends Controller {

    public function actionView() {
        $this->layout = 'mainSingle';
        $model = Article::findOne(['alias'=>$_GET['alias']]);
        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $this->addHits($model);
            return $this->render('view', [
                'model'=>$model,
            ]);
        }
    }

    public function addHits($model) {
        $model->hits++;
        $model->save();
    }

}

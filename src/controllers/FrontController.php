<?php


namespace ityakutia\blog\controllers;


use Yii;
use blog\models\ArticleCategory;
use blog\models\Article;
use blog\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class FrontController extends Controller
{
    public function actionIndex($filter_category_id = null): string
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams, $filter_category_id);
        $categories = ArticleCategory::find()->where(['is_publish' => true])->all();

        $view = Yii::$app->params['custom_view_for_modules']['blog_front']['index'] ?? 'index';

        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $view = Yii::$app->params['custom_view_for_modules']['blog_front']['view'] ?? 'view';

        $model = $this->findModel($id);
        return $this->render($view, [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


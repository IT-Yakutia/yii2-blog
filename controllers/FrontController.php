<?php


namespace blog\controllers;


use Yii;
use yii\db\ActiveRecord;
use yii\web\Controller;
use uraankhayayaal\page\models\Page;

use yii\web\NotFoundHttpException;


class FrontController extends Controller
{
    public function actionView($slug): string
    {
        $view = Yii::$app->params['custom_view_for_modules']['page_front']['view'] ?? 'view';

        $model = $this->findModel($slug);
        return $this->render($view, [
            'model' => $model,
        ]);
    }

    /**
     * @param $slug
     * @return array|ActiveRecord|null
     * @throws NotFoundHttpException
     */
    protected function findModel($slug)
    {
        if (($model = Page::findOneForFront($slug)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

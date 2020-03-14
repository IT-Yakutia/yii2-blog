<?php


namespace blog\controllers;


use uraankhayayaal\sortable\actions\Sorting;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use uraankhayayaal\page\models\PageMenuItem;
use uraankhayayaal\page\models\PageMenu;
use uraankhayayaal\page\models\PageMenuItemSearch;
use yii\web\NotFoundHttpException;


class BackMenuItemController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['page_menu']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'sorting' => [
                'class' => Sorting::class,
                'query' => PageMenuItem::find(),
            ],
        ];
    }

    /**
     * @param $page_menu_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($page_menu_id)
    {
        $page_menu = $this->findPageMenuModel($page_menu_id);

        $searchModel = new PageMenuItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $page_menu->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'page_menu' => $page_menu,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $page_menu_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate($page_menu_id)
    {
        $model = new PageMenuItem();
        $page_menu = $this->findPageMenuModel($page_menu_id);
        $model->page_menu_id = $page_menu->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect(['index', 'page_menu_id' => $page_menu->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        $load = $model->load($post);

        if ($load && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно изменена!');
            return $this->redirect(['index', 'page_menu_id' => $model->page_menu_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $page_menu_id = $model->page_menu_id;
        if ($model->delete() !== false)
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        return $this->redirect(['index', 'page_menu_id' => $page_menu_id]);
    }

    /**
     * @param $id
     * @return PageMenuItem|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = PageMenuItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findPageMenuModel($page_menu_id)
    {
        if (($model = PageMenu::findOne($page_menu_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

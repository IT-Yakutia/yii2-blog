<?php

namespace blog\controllers;

use blog\models\Article;
use blog\models\ArticleSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use vova07\imperavi\actions\UploadFileAction;
use vova07\imperavi\actions\GetImagesAction;
use vova07\imperavi\actions\GetFilesAction;
use uraankhayayaal\materializecomponents\imgcropper\actions\UploadAction;
use yii\web\NotFoundHttpException;


class BackController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['news']
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

    public function actions(): array
    {
        return [
            'image-upload' => [
                'class' => UploadFileAction::class,
                'url' => Yii::$app->params['domain'].'/images/imperavi/article/',
                'path' => '@frontend/web/images/imperavi/article/',
                'translit' => true,
            ],
            'file-upload' => [
                'class' => UploadFileAction::class,
                'url' => Yii::$app->params['domain'].'/images/imperavi/article/',
                'path' => '@frontend/web/images/imperavi/article/',
                'uploadOnlyImage' => false,
                'translit' => true,
            ],
            'images-get' => [
                'class' => GetImagesAction::class,
                'url' => Yii::$app->params['domain'].'/images/imperavi/article/',
                'path' => '@frontend/web/images/imperavi/article/',
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']],
            ],
            'files-get' => [
                'class' => GetFilesAction::class,
                'url' => Yii::$app->params['domain'].'/images/imperavi/article/',
                'path' => '@frontend/web/images/imperavi/article/',
                'options' => ['only' => ['*.txt', '*.md', '*.zip', '*.rar', '*.docx', '*.doc', '*.pdf', '*.xls']],
            ],
            'uploadImg' => [
                'class' => UploadAction::class,
                'url' => Yii::$app->params['domain'].'/images/uploads/article/',
                'path' => '@frontend/web/images/uploads/article/',
                'maxSize' => 10485760,
            ]
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Url::remember();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $post = Yii::$app->request->post();
        $load = $model->load($post);

        if ($load && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect(Url::previous());
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        $load = $model->load($post);

        if ($load && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно изменена!');
            return $this->redirect(Url::previous());
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete() !== false) {
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        }

        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Article
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

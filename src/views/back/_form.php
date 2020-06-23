<?php

use ityakutia\gallery\models\GalleryArticle;
use ityakutia\blog\models\ArticleCategory;
use ityakutia\gallery\widgets\imgUploader\WGalleryImgUploader;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\materializecomponents\imgcropper\Cropper;
use uraankhayayaal\redactor\RedactorWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model ityakutia\blog\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <p></p>
    <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#article_tab_main">Основное</a></li>
        <li class="tab col s3 <?= $model->isNewRecord ? "disabled" : ""; ?>"><a href="#article_tab_gallery" class="<?= $model->isNewRecord ? "tooltipped" : ""; ?>" data-position="bottom" data-tooltip="Вкладка будет доступна после сохранения Новости">Фотогалерея</a></li>
    </ul>

    <div id="article_tab_main">
        <?php $form = ActiveForm::begin([
            'errorCssClass' => 'red-text',
        ]); ?>

        <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php
        $list = ArrayHelper::map(ArticleCategory::find()->where(['is_publish' => true])->all(),'id','title');
        $setted_values = ArrayHelper::map($model->articleCategorySets, 'article_category_id', 'article_id');
        ?>
        <div class="input-field">
            <select multiple name="<?= Html::getInputName($model, 'categories'); ?>[]">
                <option value="" disabled>Выберите</option>
                <?php foreach ($list as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (array_key_exists($key, $setted_values)) ? 'selected' : ''; ?> ><?= $value ?></option>
                <?php } ?>
            </select>
            <label><?= $model->getAttributeLabel('categories'); ?></label>
        </div>

        <?= $form->field($model, 'photo')->widget(Cropper::class, [
            'aspectRatio' => (
                !empty(Yii::$app->params['ext_blog_img_h']) ? Yii::$app->params['ext_blog_img_h'] : 525
                )/(
                !empty(Yii::$app->params['ext_blog_img_w']) ? Yii::$app->params['ext_blog_img_w'] : 525
                ),
            'maxSize' => [
                !empty(Yii::$app->params['ext_blog_img_h']) ? Yii::$app->params['ext_blog_img_w'] : 525,
                !empty(Yii::$app->params['ext_blog_img_w']) ? Yii::$app->params['ext_blog_img_h'] : 525,
                'px'
            ],
            'minSize' => [10, 10, 'px'],
            'startSize' => [100, 100, '%'],
            'uploadUrl' => Url::to(['/blog/back/uploadImg']),
        ]); ?>
        <small>Your upload img have to has size: <?= !empty(Yii::$app->params['ext_blog_img_w']) ? Yii::$app->params['ext_blog_img_w'] : 525 ?>x<?= !empty(Yii::$app->params['ext_blog_img_h']) ? Yii::$app->params['ext_blog_img_h'] : 525 ?>px</small>

        <?= $form->field($model, 'content')->widget(RedactorWidget::class, [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'imageUpload' => Url::to(['/blog/back/image-upload']),
                'fileUpload' => Url::to(['/blog/back/file-upload']),
                'imageManagerJson' => Url::to(['/blog/back/images-get']),
                'fileManagerJson' => Url::to(['/blog/back/files-get']),
                'plugins' => [
                    'fullscreen',
                    'imagemanager',
                    'filemanager',
                    'fontcolor',
                    'fontfamily',
                    'fontsize',
                    'limiter',
                    'table',
                    'textdirection',
                    'textexpander',
                    'video',
                ]
            ],
            'class' => 'materialize-textarea',
        ]); ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
        </div>
        <div class="fixed-action-btn">
            <?= Html::submitButton('<i class="material-icons">save</i>', [
                'class' => 'btn-floating btn-large waves-effect waves-light tooltipped',
                'title' => 'Сохранить',
                'data-position' => "left",
                'data-tooltip' => "Сохранить",
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div id="article_tab_gallery">
        <?= WGalleryImgUploader::widget([
            'model' => $model,
            'galleryClass' => GalleryArticle::class,
        ]) ?>
    </div>

</div>

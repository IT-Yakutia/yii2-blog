<?php

use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\materializecomponents\imgcropper\Cropper;
use uraankhayayaal\page\models\Page;
use uraankhayayaal\redactor\RedactorWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model blog\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <div class="row">
        <div class="col s12 m6">
            <?= WCheckbox::widget(['model' => $model, 'attribute' => 'no_title']); ?>
            <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>
        </div>
        <div class="col s12 m6">
            <?= $form->field($model, 'width_type')->dropDownList(Page::WIDTH_TYPES) ?>
        </div>
    </div>



    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord) { ?>
        <div class="input-field">
            <input disabled value="<?= '/'.$model->slug; ?>" id="disabled" type="text" class="validate">
            <label for="disabled">Относительный url страницы</label>
        </div>

        <div class="input-field">
            <input disabled value="<?= Yii::$app->params['domain'].$model->slug; ?>" id="disabled" type="text" class="validate">
            <label for="disabled">Асолютный url страницы</label>
            <?= Html::a("Перейти", Yii::$app->urlManagerFrontend->createUrl(['/page/front/view', 'slug' => $model->slug]), ['target' => "_blank"]); ?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'photo')->widget(Cropper::class, [
        'aspectRatio' => 380/380,
        'maxSize' => [1380, 1380, 'px'],
        'minSize' => [10, 10, 'px'],
        'startSize' => [100, 100, '%'],
        'uploadUrl' => Url::to(['/page/back/uploadImg']),
    ]); ?>

    <?= $form->field($model, 'content')->widget(RedactorWidget::class, [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/page/back/image-upload']),
            'fileUpload' => Url::to(['/page/back/file-upload']),
            'imageManagerJson' => Url::to(['/page/back/images-get']),
            'fileManagerJson' => Url::to(['/page/back/files-get']),
            'plugins' => [
                'fullscreen',
                'imagemanager',
                'filemanager',
            ]
        ],
        'class' => 'materialize-textarea',
    ]); ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

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

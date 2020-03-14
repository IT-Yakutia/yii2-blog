<?php

use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\page\models\Page;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model blog\models\PageMenuItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-menu-item-form">

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord) { ?>
        <?= $form->field($model, 'page_id')->dropDownList(ArrayHelper::map(Page::find()->joinWith('pageMenuItems')->where(['page_id' => null])->all(),'id','title'), ['prompt' => 'Выберите']) ?>
    <?php }else{ ?>
        <?= $form->field($model, 'page_id')->dropDownList(ArrayHelper::map(Page::find()->joinWith('pageMenuItems')->where(['page_menu_item.id' => $model->id])->all(),'id','title'), ['prompt' => 'Выберите']) ?>
    <?php } ?>

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



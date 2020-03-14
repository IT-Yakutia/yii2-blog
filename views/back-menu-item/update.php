<?php

/* @var $this yii\web\View */
/* @var $model blog\models\PageMenuItem */

$this->title = 'Редактирование: ' . $model->name;
?>
<div class="page-menu-item-update">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>



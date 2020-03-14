<?php

/* @var $this yii\web\View */
/* @var $model blog\models\PageMenuItem */

$this->title = 'Новый элемент меню';
?>
<div class="page-menu-item-create">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>



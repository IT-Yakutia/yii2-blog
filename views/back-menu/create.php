<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model blog\models\PageMenu */

$this->title = 'Новое меню';
?>
<div class="page-menu-create">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>


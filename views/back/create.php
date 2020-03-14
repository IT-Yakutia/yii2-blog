<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model blog\models\Page */

$this->title = 'Новая страница';
// $this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model blog\models\Article */

$this->title = 'Новая новость';
?>
<div class="article-create">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>


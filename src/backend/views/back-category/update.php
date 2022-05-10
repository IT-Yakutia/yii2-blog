<?php

/* @var $this yii\web\View */
/* @var $model ityakutia\blog\models\ArticleCategory */

$this->title = 'Редактирование: ' . $model->title;
?>
<div class="article-category-update">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>


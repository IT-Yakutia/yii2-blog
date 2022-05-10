<?php

/* @var $this yii\web\View */
/* @var $model ityakutia\blog\models\ArticleCategory */

$this->title = 'Новая категория новости';
?>
<div class="article-category-create">
    <div class="row">
        <div class="col s12">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>



<?php

$this->title = $model->title;

if(
isset(Yii::$app->params['meta_description'], Yii::$app->params['meta_keywords'], Yii::$app->params['meta_image'], Yii::$app->params['meta_type'])
){
    Yii::$app->params['meta_description']['content'] = $model->seoDescription;
    Yii::$app->params['meta_keywords']['content'] = $model->metaKeywords;
    if(!empty($model->photo)) Yii::$app->params['meta_image']['content'] = $model->photo;
    Yii::$app->params['meta_type']['content'] = 'article';
}

$this->registerMetaTag([
    'property' => 'og:article:published_time',
    'content' => Yii::$app->formatter->asDatetime($model->created_at),
]);
$this->registerMetaTag([
    'property' => 'og:article:modified_time',
    'content' => Yii::$app->formatter->asDatetime($model->updated_at),
]);
$this->registerMetaTag([
    'property' => 'og:article:author',
    'content' => Yii::$app->name,
]);

?>

<div id="document">
    <section id="document__content" class="<?= ($model->width_type == $model::TYPE_SMALL ? 'container' : 'container-fluid') ?> z-3">
        <div class="spacer50"></div>
        <div class="row h-100">
            <div class="col-12 col-sm-10 offset-sm-1 col-xl-8 offset-xl-2">
                <div class="wrapper bg-textile b-shadow">
                    <div class="inner">
                        <div class="spacer50"></div>
                        <div class="row">
                            <div class="col-10 offset-1">
                                <div class="content">
                                    <picture>
                                        <source srcset="<?= pathinfo($model->photo)['dirname'] . '/' . pathinfo($model->photo)['filename'] . '.webp'; ?>" type="image/webp">
                                        <img src="<?= $model->photo ?>" alt="">
                                    </picture>
                                    <?= $this->render('_menu', [
                                        'model' => $model,
                                    ]) ?>
                                    <?php if (!$model->no_title) { ?>
                                        <h1 style="font-size: 1rem;"><?= $this->title; ?></h1>
                                    <?php } ?>
                                    <?= $model->content; ?>
                                </div>
                            </div>
                        </div>
                        <div class="spacer50"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer100"></div>
    </section>

    <div class="layer layer-up z-3">
        <img src="/images/waves/anim/up.png" draggable="false">
    </div>
</div>

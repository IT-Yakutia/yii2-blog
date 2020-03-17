<?php

use yii\helpers\Url;

$this->title = $model->title;

?>

<div id="blogpost">
    <section id="blogpost__news" class="container-fluid z-3 background-leaves">
        <div class="spacer50"></div>
        <div class="row h-100">
            <div class="col-12 col-sm-10 offset-sm-1 col-xl-8 offset-xl-2">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <ul class="sections list-inline mb-0">
                            <?php foreach ($model->articleCategorySets as $key => $categorySet) { ?>
                                <li class="list-inline-item"><a href="<?= Url::toRoute(['/blog/front/index', 'filter_category_id' => $categorySet->articleCategory->id]); ?>" class="btn btn-outline"><?= $categorySet->articleCategory->title ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="spacer25"></div>
                    </div>
                </div>

                <div class="wrapper bg-textile b-shadow">
                    <div class="inner">
                        <div class="spacer50"></div>
                        <div class="row">
                            <div class="col-10 offset-1">
                                <div class="content">
                                    <h2 class="title mb-4"><?= $model->title ?></h2>
                                    <div class="share d-flex justify-content-between mb-5">
                                        <div class="d-flex align-items-center">
                                            <i class="mr-3"><?= Yii::t('blog', 'blog_share'); ?></i>
                                            <?= \frontend\widgets\social\Share::widget(['id' => $model->id, 'url' => Url::current([], true), 'text' => $model->title])?>
                                        </div>

                                        <time datetime="2018-06-05"><i><?= Yii::$app->formatter->asDate($model->created_at) ?></i></time>
                                    </div>

                                    <div class="text">
                                        <?= $model->content ?>
                                        <div class="spacer25"></div>

                                        <?php if($model->galleryArticles) { ?>
                                            <div class="gallery d-flex align-items-center mw-100 pb-1">
                                                <?php foreach ($model->galleryArticles as $key => $gallery) { ?>
                                                    <img src="<?= $gallery->photo->original ?>" alt="<?= $gallery->photo->name ?> - <?= $gallery->photo->description ?>">
                                                <?php } ?>
                                            </div>
                                            <div class="spacer25"></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer100 d-none d-lg-block"></div>
                        <div class="spacer50 d-lg-none"></div>
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

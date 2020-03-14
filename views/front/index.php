<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

$this->title = Yii::t('app', 'our_blog');

?>

<div id="blog" class="background-leaves">
    <div class="spacer100 d-none d-lg-block"></div>
    <div class="spacer25"></div>

    <section id="blog__news" class="container-fluid z-3">
        <div class="row h-100">
            <div class="col-12 col-sm-10 offset-sm-1">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <ul class="sections list-inline mb-0">
                            <li class="list-inline-item"><a href="<?= Url::to(['/blog/front/index']); ?>" class="btn btn-outline"><?= Yii::t('blog', 'blog_all'); ?></a></li>
                            <?php foreach ($categories as $key => $model) { ?>
                                <li class="list-inline-item"><a href="<?= Url::current(['filter_category_id' => $model->id],true); ?>" class="btn btn-outline"><?= $model->title ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="spacer25"></div>
                    </div>
                </div>
                <div class="wrapper bg-textile b-shadow">
                    <div class="inner">
                        <div class="spacer50 d-none d-lg-block"></div>
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="content">
                                    <div class="card-group">
                                        <?= ListView::widget([
                                            'dataProvider' => $dataProvider,
                                            'itemOptions' => ['class' => 'item'],
                                            'itemView' => '_item',
                                            'options' => ['tag' => false, 'class' => false, 'id' => false],
                                            'itemOptions' => [
                                                'tag' => false,
                                                'class' => 'news-item',
                                            ],
                                            'layout' => '{items}',
                                            'summaryOptions' => ['class' => 'summary grey-text'],
                                            'emptyTextOptions' => ['class' => 'empty grey-text'],
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer100 d-none d-lg-block"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer50"></div>
        <div class="d-flex justify-content-center align-items-center">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'registerLinkTags' => true,
                'options' => ['class' => 'pagination'],
                'prevPageCssClass' => '',
                'nextPageCssClass' => '',
                'pageCssClass' => 'page-item',
                'nextPageLabel' => '>',
                'prevPageLabel' => '<',
                'linkOptions' => ['class' => 'page-link btn'],
                'disabledPageCssClass' => 'd-none',
            ]); ?>
        </div>
        <div class="spacer25"></div>
    </section>

    <div class="layer z-3">
        <img src="/images/waves/anim/up.png" draggable="false">
    </div>
</div>

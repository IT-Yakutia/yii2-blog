<?php

namespace ityakutia\blog\tests\fixtures;

use ityakutia\blog\models\ArticleCategorySet;
use yii\test\ActiveFixture;

class ArticleCategorySetFixture extends ActiveFixture
{
    public $modelClass = ArticleCategorySet::class;
    public $dataFile = '@ityakutia/blog/tests/_data/article-category-set.php';
    public $depends = [ArticleCategoryFixture::class, ArticleFixture::class];
}

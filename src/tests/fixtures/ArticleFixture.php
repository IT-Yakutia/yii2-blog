<?php

namespace ityakutia\blog\tests\fixtures;

use ityakutia\blog\models\Article;
use yii\test\ActiveFixture;

class ArticleFixture extends ActiveFixture
{
    public $modelClass = Article::class;
    public $dataFile = '@ityakutia/blog/tests/_data/article.php';
    public $depends = [ArticleCategoryFixture::class];
}

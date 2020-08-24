<?php

namespace ityakutia\blog\tests\fixtures;

use ityakutia\blog\models\ArticleCategory;
use yii\test\ActiveFixture;

class ArticleCategoryFixture extends ActiveFixture
{
    public $modelClass = ArticleCategory::class;
    public $dataFile = '@ityakutia/blog/tests/_data/article-category.php';
}

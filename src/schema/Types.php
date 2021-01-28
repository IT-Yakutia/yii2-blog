<?php

namespace ityakutia\blog\schema;

use frontend\schema\QueryType;
use frontend\schema\MutationType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\UnionType;

class Types {

    private static $article;
    private static $articleCategory;
    private static $articleCategorySet;

    private static $articleMutation;
    private static $articleCategoryMutation;

    public static function article()
    {
        return self::$article ?: (self::$article = new ArticleType());
    }

    public static function articleCategory()
    {
        return self::$articleCategory ?: (self::$articleCategory = new ArticleCategoryType());
    }

    public static function articleCategorySet()
    {
        return self::$articleCategorySet ?: (self::$articleCategorySet = new ArticleCategorySetType());
    }

    public static function articleMutation()
    {
        return self::$articleMutation ?: (self::$articleMutation = new ArticleMutation());
    }

    public static function articleCategoryMutation()
    {
        return self::$articleCategoryMutation ?: (self::$articleCategoryMutation = new ArticleCategoryMutation());
    }
}
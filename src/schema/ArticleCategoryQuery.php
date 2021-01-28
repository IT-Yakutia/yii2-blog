<?php

namespace ityakutia\blog\schema;

use GraphQL\Type\Definition\Type;
use ityakutia\blog\models\ArticleCategory;

class ArticleCategoryQuery{
    static function all(){
        return [
            'type' => Type::listOf(Types::articleCategory()),
            'description' => 'Все новости',
            'args' => [],
            'resolve' => function($root, $args) {
                $query = ArticleCategory::find();
                return $query->all();
            }
        ];
    }
    static function count(){
        return [
            'type' => Type::int(),
            'description' => 'Количество новостей',
            'args' => [],
            'resolve' => function($root, $args) {
                $query = ArticleCategory::find();
                return $query->count();
            }
        ];
    }
}
<?php

namespace ityakutia\blog\schema;

use GraphQL\Type\Definition\Type;
use ityakutia\blog\models\Article;

class ArticleQuery{
    static function all(){
        return [
            'type' => Type::listOf(Types::article()),
            'description' => 'Все новости',
            'args' => [],
            'resolve' => function($root, $args) {
                $query = Article::find();
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
                $query = Article::find();
                return $query->count();
            }
        ];
    }
}
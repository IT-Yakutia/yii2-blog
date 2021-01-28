<?php 

namespace ityakutia\blog\schema;

use ityakutia\blog\models\Article;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ArticleType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => "Article",
            'fields' => function() {
                return [
                    'title' => [
                        'type' => Type::string(),
                        'description' => "Заголовок",
                    ],
                    'content' => [
                        'type' => Type::string(),
                        'description' => "Содержание",
                    ],
                    'is_publish' => [
                        'type' => Type::boolean(),
                        'description' => "Опубликован",
                    ],
                    'created_at' => [
                        'type' => Type::int(),
                        'description' => "Создан",
                    ],
                    'categorySets' => [
                        'type' => Type::listOf(Types::articleCategorySet()),
                        'description' => "Спиок комментариев",
                        'resolve' => function(Article $article){
                            return $article->articleCategorySets;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
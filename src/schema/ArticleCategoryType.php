<?php 

namespace ityakutia\blog\schema;

use ityakutia\blog\models\ArticleCategory;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ArticleCategoryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => "ArticleCategory",
            'fields' => function() {
                return [
                    'title' => [
                        'type' => Type::string(),
                        'description' => "Заголовок",
                    ],
                    'is_publish' => [
                        'type' => Type::boolean(),
                        'description' => "Опубликован",
                    ],
                    'created_at' => [
                        'type' => Type::int(),
                        'description' => "Создан",
                    ],
                    'articleCategorySets' => [
                        'type' => Type::listOf(Types::articleCategorySet()),
                        'description' => "Спиок назначений",
                        'resolve' => function(ArticleCategory $articleCategory){
                            return $articleCategory->articleCategorySets;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
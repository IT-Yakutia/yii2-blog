<?php 

namespace ityakutia\blog\schema;

use ityakutia\blog\models\ArticleCategorySet;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ArticleCategorySetType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => "Назначения категорий новостей",
            'fields' => function() {
                return [
                    'article_id' => [
                        'type' => Type::string(),
                        'description' => "ID новости",
                    ],
                    'article_category_id' => [
                        'type' => Type::string(),
                        'description' => "ID категории новости",
                    ],
                    'article' => [
                        'type' => Types::article(),
                        'description' => "Новость",
                        'resolve' => function(ArticleCategorySet $articleCategorySet){
                            return $articleCategorySet->article;
                        }
                    ],
                    'category' => [
                        'type' => Types::articleCategory(),
                        'description' => "Категория новости",
                        'resolve' => function(ArticleCategorySet $articleCategorySet){
                            return $articleCategorySet->articleCategory;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
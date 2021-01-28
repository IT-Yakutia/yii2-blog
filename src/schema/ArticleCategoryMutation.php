<?php

namespace ityakutia\blog\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use ityakutia\blog\models\ArticleCategory;

class ArticleCategoryMutation extends ObjectType
{
    static function create()
    {
        return [
            'type' => Types::articleCategoryMutation(),
            'resolve' => function($root, $args){
                return new ArticleCategory();
            }
        ];
    }

    static function update()
    {
        return [
            'args' => [
                'id' => Type::nonNull(Type::int()),
            ],
            'type' => Types::articleCategoryMutation(),
            'resolve' => function($root, $args){
                return ArticleCategory::findOne($args['id']);
            }
        ];
    }

    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'create' => [
                        'type' => Type::boolean(),
                        'description' => 'Создание категории новости',
                        'args' => [
                            'title' => Type::nonNull(Type::string()),
                            'is_publish' => Type::boolean(),
                        ],
                        'resolve' => function(ArticleCategory $articleCategory, $args){
                            $articleCategory->setAttributes($args);
                            return $articleCategory->save();
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
<?php

namespace ityakutia\blog\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use ityakutia\blog\models\Article;

class ArticleMutation extends ObjectType
{
    static function create()
    {
        return [
            'type' => Types::articleMutation(),
            'resolve' => function($root, $args){
                return new Article();
            }
        ];
    }

    static function update() // TODO возможно для него нужно делать новый класс, чтобы изменять только те свойства, которые указаны
    {
        return [
            'args' => [
                'id' => Type::nonNull(Type::int()),
            ],
            'type' => Types::articleMutation(),
            'resolve' => function($root, $args){
                return Article::findOne($args['id']);
            }
        ];
    }

    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    // Метод для создания Post
                    'create' => [
                        'type' => Type::boolean(),
                        'description' => 'Создание новости',
                        'args' => [
                            'title' => Type::nonNull(Type::string()),
                            'content' => Type::string(),
                            'is_publish' => Type::boolean(),
                            'photo' => Type::string(),
                            'video' => Type::string(),
                            'description' => Type::string(),
                            'keywords' => Type::string(),
                            'categories' => Type::listOf(Type::int()),
                        ],
                        'resolve' => function(Article $article, $args){
                            $article->setAttributes($args);
                            return $article->save();
                        }
                    ],
                    // Метод для редактирования Post
                    // 'update' => [
                    //     'type' => Type::boolean(),
                    //     'description' => 'Редактирование новости',
                    //     'args' => [
                    //         'title' => Type::nonNull(Type::string()),
                    //         'content' => Type::string(),
                    //         'is_publish' => Type::boolean(),
                    //         'photo' => Type::string(),
                    //         'video' => Type::string(),
                    //         'description' => Type::string(),
                    //         'keywords' => Type::string(),
                    //         'categories' => Type::listOf(Type::int()),
                    //     ],
                    //     'resolve' => function(Article $article, $args){
                    //         $article->setAttributes($args);
                    //         return $article->save();
                    //     }
                    // ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
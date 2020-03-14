<?php


namespace blog\models;

use uraankhayayaal\page\models\Page as BasePage;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use uraankhayayaal\sortable\behaviors\Sortable;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


class Page extends BasePage
{
    const TYPE_LARGE = 0; // default
    const TYPE_SMALL = 1;

    const WIDTH_TYPES = [
        self::TYPE_LARGE => "Длинная ширина страницы",
        self::TYPE_SMALL => "Узкая ширина страницы",
    ];

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'sortable' => [
                'class' => Sortable::class,
                'query' => self::find(),
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'user_id',
                ],
                'value' => static function ($event) {
                    return Yii::$app->user->id;
                },
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique' => true,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['sort', 'user_id', 'is_publish', 'status', 'created_at', 'updated_at', 'no_title', 'width_type'], 'integer'],
            [['title', 'photo', 'slug', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
            ['slug', 'unique'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'about'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'contact'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'login'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'blog'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'games'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'career'],
            ['slug', 'compare', 'operator' => '!=', 'compareValue' => 'darkwood-quiz'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'photo' => 'Фото',
            'sort' => 'Сортировочный вес',
            'slug' => 'Slug',
            'user_id' => 'Автор',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'no_title' => 'Не показывать заголовок',
            'width_type' => 'Тип страницы',
            'meta_description' => 'SEO описание',
            'meta_keywords' => 'SEO ключевые слова'
        ];
    }

    public static function findOneForFront($slug)
    {
        if(Yii::$app->user->can("page"))
            return self::find()->where(['slug' => $slug])->one();
        else
            return self::find()->where(['slug' => $slug, 'is_publish' => true])->one();
    }

    /**
     * @return ActiveQuery
     */
    public function getPageMenuItems(): ActiveQuery
    {
        return $this->hasMany(PageMenuItem::class, ['page_id' => 'id']);
    }
}

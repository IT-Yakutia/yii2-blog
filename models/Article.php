<?php

namespace blog\models;

use yii\behaviors\TimestampBehavior;
use gallery\models\GalleryArticle;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $photo
 * @property string $video
 * @property int $is_publish
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $description
 * @property int $keywords
 *
 * @property ArticleCategorySet[] $articleCategorySets
 * @property GalleryArticle[] $galleryArticles
 */
class Article extends ActiveRecord
{
    public $categories = [];

    public static function tableName(): string
    {
        return 'article';
    }
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo', 'video', 'description', 'keywords'], 'string', 'max' => 255],
            ['categories', 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'content' => 'Содержание',
            'photo' => 'Фото',
            'video' => 'Ссылка на видео в youtube',
            'is_publish' => 'Опубликован',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Редактирован',
            'categories' => 'Категории',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        foreach ($this->categories as $key => $category) {
            $isSeted = ArticleCategorySet::find()->where( [ 'article_id' => $this->id, 'article_category_id' => $category ] )->exists();
            if(!$isSeted){
                $model = new ArticleCategorySet();
                $model->article_id = $this->id;
                $model->article_category_id = $category;
                $model->save();
            }
        }

        ArticleCategorySet::deleteAll(['AND', 'article_id = :article_id', ['NOT IN', 'article_category_id', $this->categories]], [':article_id' => $this->id]);
    }

    /**
     * @return ActiveQuery
     */
    public function getArticleCategorySets(): ActiveQuery
    {
        return $this->hasMany(ArticleCategorySet::class, ['article_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getGalleryArticles(): ActiveQuery
    {
        return $this->hasMany(GalleryArticle::class, ['article_id' => 'id']);
    }
}

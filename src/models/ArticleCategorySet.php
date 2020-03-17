<?php


namespace ityakutia\blog\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_category_set".
 *
 * @property int $id
 * @property int $article_id
 * @property int $article_category_id
 *
 * @property Article $article
 * @property ArticleCategory $articleCategory
 */
class ArticleCategorySet extends ActiveRecord
{
    public static function tableName(): string 
    {
        return 'article_category_set';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'article_category_id'], 'required'],
            [['article_id', 'article_category_id'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
            [['article_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::class, 'targetAttribute' => ['article_category_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'article_id' => 'Новость',
            'article_category_id' => 'Категория',
        ];
    }

    public function getArticle(): ActiveQuery
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    public function getArticleCategory(): ActiveQuery
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'article_category_id']);
    }
}

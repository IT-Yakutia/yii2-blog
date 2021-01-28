<?php


namespace ityakutia\blog\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "article_category".
 *
 * @property int $id
 * @property string $title
 * @property int $is_publish
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ArticleCategorySet[] $articleCategorySets
 */
class ArticleCategory extends ActiveRecord
{

    public static function tableName()
    {
        return 'article_category';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['is_publish'], 'boolean'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'is_publish' => 'Опубликован',
            'status' => 'Статус',
            'created_at' => 'Зарегистрирован',
            'updated_at' => 'Редактирован',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getArticleCategorySets()
    {
        return $this->hasMany(ArticleCategorySet::class, ['article_category_id' => 'id']);
    }
}

<?php

use yii\db\Migration;

/**
 * Class m200314_124229_page_init
 */
class m200314_124229_blog_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'photo' => $this->string(),
            'video' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('article_category_set', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'article_category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('article_category_set-article-fkey','article_category_set','article_id','article','id','CASCADE','CASCADE');
        $this->createIndex('article_category_set-article-idx','article_category_set','article_id');

        $this->addForeignKey('article_category_set-article_category-fkey','article_category_set','article_category_id','article_category','id','CASCADE','CASCADE');
        $this->createIndex('article_category_set-article_category-idx','article_category_set','article_category_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('article_category_set-article_category-fkey','article_category_set');
        $this->dropIndex('article_category_set-article_category-idx','article_category_set');

        $this->dropForeignKey('article_category_set-article-fkey','article_category_set');
        $this->dropIndex('article_category_set-article-idx','article_category_set');

        $this->dropTable('article_category_set');

        $this->dropTable('article');

        $this->dropTable('article_category');
    }

}

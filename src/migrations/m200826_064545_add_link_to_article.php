<?php

use yii\db\Migration;

/**
 * Class m200826_064545_add_link_to_article
 */
class m200826_064545_add_link_to_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'link', $this->string());
        $this->alterColumn('article', 'content', $this->getDb()->getSchema()->createColumnSchemaBuilder('mediumtext'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('article', 'content', $this->text());
        $this->dropColumn('article', 'link');
    }

}

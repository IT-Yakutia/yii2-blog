<?php

use yii\db\Migration;

/**
 * Class m200911_045716_change_article_content_collation
 */
class m200911_045716_change_article_content_collation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {   
        if($this->db->charset === 'utf8mb4') {
            $this->execute('ALTER TABLE `article` MODIFY `content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        }        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if($this->db->charset === 'utf8mb4') {
            $this->execute('ALTER TABLE `article` MODIFY `content` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        }
    }

}

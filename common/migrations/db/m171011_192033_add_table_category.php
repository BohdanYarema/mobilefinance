<?php

use yii\db\Migration;

class m171011_192033_add_table_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string(512),
            'thumbnail_base_url'    => $this->string(1024),
            'thumbnail_path'        => $this->string(1024),
            'status'                => $this->smallInteger(),
            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_accounting_category', '{{%accounting}}', 'category_id', '{{%category}}', 'id', 'cascade', 'cascade');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_accounting_category', '{{%accounting}}');
        $this->dropTable('{{%category}}');
    }
}

<?php

use yii\db\Migration;

class m171012_085841_add_table_tags extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tags}}', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string(512),
            'status'                => $this->smallInteger(),
            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%tag_to_accounting}}', [
            'id'                    => $this->primaryKey(),
            'tags_id'               => $this->integer(),
            'accounting_id'         => $this->integer(),
            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_accounting_tag_to_accounting', '{{%tag_to_accounting}}', 'accounting_id', '{{%accounting}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_tags_tag_to_accounting', '{{%tag_to_accounting}}', 'tags_id', '{{%tags}}', 'id', 'cascade', 'cascade');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_accounting_tag_to_accounting', '{{%accounting}}');
        $this->dropForeignKey('fk_tags_tag_to_accounting', '{{%accounting}}');
        $this->dropTable('{{%tags}}');
        $this->dropTable('{{%tag_to_accounting}}');
    }
}

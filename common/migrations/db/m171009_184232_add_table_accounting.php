<?php

use yii\db\Migration;

class m171009_184232_add_table_accounting extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%accounting}}', [
            'id'            => $this->primaryKey(),
            'price'         => $this->float(),
            'dates'         => $this->integer(),
            'status'        => $this->smallInteger(),
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%accounting}}');
    }
}

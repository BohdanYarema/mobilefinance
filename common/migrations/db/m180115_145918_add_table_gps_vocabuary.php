<?php

use yii\db\Migration;

/**
 * Class m180115_145918_add_table_gps_vocabuary
 */
class m180115_145918_add_table_gps_vocabuary extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gps_data}}', [
            'id'                    => $this->primaryKey(),
            'gps_x'                 => $this->float(),
            'gps_y'                 => $this->float(),
            'name'                  => $this->string(512),
            'status'                => $this->smallInteger(),
            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),
        ], $tableOptions);

        $this->addColumn('{{accounting}}', 'gps_id', $this->integer());
        $this->addColumn('{{accounting}}', 'gps_title', $this->string(1024));
        $this->addColumn('{{accounting}}', 'gps_status', $this->integer());
    }

    public function safeDown()
    {
        $this->dropTable('{{%gps_data}}');
        $this->dropColumn('{{accounting}}', 'gps_id');
        $this->dropColumn('{{accounting}}', 'gps_title');
        $this->dropColumn('{{accounting}}', 'gps_status');
    }
}

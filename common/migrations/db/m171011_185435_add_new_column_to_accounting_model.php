<?php

use yii\db\Migration;

class m171011_185435_add_new_column_to_accounting_model extends Migration
{
    public function safeUp()
    {
        $this->addColumn('accounting', 'name', $this->string(1024));
        $this->addColumn('accounting', 'category_id', $this->integer());
        $this->addColumn('accounting', 'thumbnail_base_url', $this->string(1024));
        $this->addColumn('accounting', 'thumbnail_path', $this->string(1024));
    }

    public function safeDown()
    {
        $this->dropColumn('accounting', 'name');
        $this->dropColumn('accounting', 'category_id');
        $this->dropColumn('accounting', 'thumbnail_base_url');
        $this->dropColumn('accounting', 'thumbnail_path');
    }
}

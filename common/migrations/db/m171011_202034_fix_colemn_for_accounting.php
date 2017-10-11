<?php

use yii\db\Migration;

class m171011_202034_fix_colemn_for_accounting extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('accounting', 'thumbnail_base_url');
        $this->dropColumn('accounting', 'thumbnail_path');
        $this->addColumn('accounting', 'gps_x', $this->float());
        $this->addColumn('accounting', 'gps_y', $this->float());
    }

    public function safeDown()
    {
        $this->addColumn('accounting', 'thumbnail_base_url', $this->string(1024));
        $this->addColumn('accounting', 'thumbnail_path', $this->string(1024));
        $this->dropColumn('accounting', 'gps_x');
        $this->dropColumn('accounting', 'gps_y');
    }
}

<?php

use yii\db\Migration;

class m171103_233006_add_color_to_category extends Migration
{
    public function safeUp()
    {
        $this->addColumn("category", "color", $this->string(16)->defaultValue("#666666"));
    }

    public function safeDown()
    {
        $this->dropColumn("category", "color");
    }
}

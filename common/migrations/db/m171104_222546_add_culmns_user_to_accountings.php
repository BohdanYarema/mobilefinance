<?php

use yii\db\Migration;

class m171104_222546_add_culmns_user_to_accountings extends Migration
{
    public function safeUp()
    {
        $this->addColumn("accounting", "user_id", $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn("accounting", "user_id");
    }
}

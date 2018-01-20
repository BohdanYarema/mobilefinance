<?php

use yii\db\Migration;

/**
 * Class m180120_125716_add_column_to_account
 */
class m180120_125716_add_column_to_account extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{accounting}}', 'type', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{accounting}}', 'type');
    }
}

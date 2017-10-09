<?php

class m171009_092925_transfer_logs extends CDbMigration
{
    public function up()
    {
        $this->createTable('transfer_logs', [
            'id' => 'int(11) NOT NULL',
            'user_id' => 'int(11) NOT NULL',
            'date_time' => 'int(11) NOT NULL',
            'resource' => 'varchar(150) NOT NULL',
            'transferred' => 'bigint(20) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('transfer_logs');
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
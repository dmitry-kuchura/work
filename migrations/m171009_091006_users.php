<?php

class m171009_091006_users extends CDbMigration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => 'pk',
            'name' => 'varchar(150) NOT NULL',
            'email' => 'varchar(50) NOT NULL',
            'company_id' => 'int(10) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
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
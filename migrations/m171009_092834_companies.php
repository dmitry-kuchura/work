<?php

class m171009_092834_companies extends CDbMigration
{
    public function up()
    {
        $this->createTable('companies', [
            'id' => 'pk',
            'name' => 'varchar(50) NOT NULL',
            'quota' => 'bigint(20) NOT NULL DEFAULT 0',
            'quota_type' => 'char(2) NOT NULL',
            'created_at' => 'int(11) DEFAULT NULL',
            'updated_at' => 'int(11) DEFAULT null',
        ]);
    }

    public function down()
    {
        $this->dropTable('companies');
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
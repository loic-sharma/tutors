<?php

class Create_Pupils_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pupils', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->integer('tutor_id');
			$table->integer('course_id');
			$table->integer('tutorial_id');

			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pupils');
	}

}
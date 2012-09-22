<?php

class Create_Tutorials_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tutorials', function($table)
		{
			$table->increments('id');

			$table->integer('tutor_id');
			$table->integer('course_id');
			$table->string('name');
			$table->text('description');
			$table->integer('likes');

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
		Schema::drop('tutorials');
	}

}
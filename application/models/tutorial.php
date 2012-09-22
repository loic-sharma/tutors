<?php

class Tutorial extends Eloquent {

	/**
	 * Set the table name to improve performance.
	 *
	 * @var string
	 */
	public static $table = 'tutorials';

	/**
	 * A tutorial belongs to a course.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Course
	 */
	public function course()
	{
		return $this->belongs_to('course');
	}

	/**
	 * A tutor teaches the tutorial.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function tutor()
	{
		return $this->belongs_to('user', 'tutor_id');
	}

	/**
	 * Each session is attended by students.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many_And_Belongs_To
	 */
	public function pupils()
	{
		return $this->has_many_and_belongs_to('user', 'pupils');
	}
}
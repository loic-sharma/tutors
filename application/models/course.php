<?php

class Course extends Eloquent {

	/**
	 * Set the table name to improve performance.
	 *
	 * @var string
	 */
	public static $table = 'courses';

	/**
	 * Courses may have several tutoring sessions.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function tutorials()
	{
		return $this->has_many('tutorial');
	}
}
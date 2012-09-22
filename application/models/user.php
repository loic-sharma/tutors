<?php

class User extends Eloquent {

	/**
	 * Set the table name to improve performance.
	 *
	 * @var string
	 */
	public static $table = 'users';

	/**
	 * Users can join tutoring sessions. These are cached here
	 * within a request to optimize speed.
	 *
	 * @var array
	 */
	public $tuts;

	/**
	 * Automatically hash the password when it is set.
	 *
	 * @param  string  $password
	 * @return void
	 */
	public function set_password($password)
	{
		$this->set_attribute('password', Hash::make($password));
	}

	/**
	 * A user can have many tutoring sessions.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function tutorials()
	{
		return $this->has_many('tutorial', 'tutor_id');
	}

	/**
	 * A user can participate in many tutoring sessions.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many_And_Belongs_To
	 */
	public function sessions()
	{
		return $this->has_many_and_belongs_to('tutorial', 'pupils');
	}

	/**
	 * Check if the user is in a tutoring session.
	 *
	 * @param  int   $tutorial_id
	 * @return bool
	 */
	public function in($tutorial_id)
	{
		foreach($this->sessions as $session)
		{
			if($session->id == $tutorial_id)
			{
				return true;
			}
		}

		return false;
	}
}
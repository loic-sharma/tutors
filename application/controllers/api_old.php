<?php

class Api_Controller extends Base_Controller {

	/**
	 * Retreive the course information.
	 *
	 * @param  string  $name
	 * @return string
	 */
	public function any_course($name)
	{
		$courses = Course::where('name', 'LIKE', '%'.$name.'%')->get('id');

		$ids = array();

		foreach($courses as $course)
		{
			$ids[] = $course->id;
		}

		if(count($ids) == 0)
		{
			$result = array();
		}

		else
		{
			$result = Tutorial::with('tutor')
						->where_in('course_id', $ids)
						->order_by('likes', 'desc')
						->take(100)
						->get();

			foreach($result as $key => $tutorial)
			{
				$result[$key] = $tutorial->to_array();

				unset($result[$key]['tutor']['password']);
			}
		}

		return json_encode($result);
	}

	/**
	 * Retreive the tutoring session data.
	 *
	 * @param  int    $id
	 * @return string
	 */
	public function any_tutoring_session($id)
	{
		$tutorial = Tutorial::with('tutor')
					->where_id($id)
					->first()
					->to_array();

		unset($tutorial['tutor']['password']);

		return json_encode($tutorial);
	}

	/**
	 * Get a user's information.
	 *
	 * @param  int    $id
	 * @return string
	 */
	public function any_user($id)
	{
		$user = User::with('tutorials')
					->where_id($id)
					->first(array('id', 'email', 'name', 'likes', 'created_at', 'updated_at'))
					->to_array();

		return json_encode($user);
	}
}
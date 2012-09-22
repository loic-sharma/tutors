<?php

class Tutorial_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->filter('before', 'auth');
	}

	/**
	 * Show the user's profile.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$tutorials = Tutorial::take(100)->get();

		$this->layout->title = 'Tutoring Sessions';
		$this->layout->content = View::make('tutorial.index', compact('tutorials'));
	}

	/**
	 * Display the form to create a new tutorial.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$courses = array();

		foreach(Course::all() as $course)
		{
			$courses[$course->id] = $course->name;
		}

		$this->layout->title   = 'Create a new Tutorial';
		$this->layout->content = View::make('tutorial.create', compact('courses'));
	}

	/**
	 * Create a new post.
	 *
	 * @return void
	 */
	public function post_create()
	{
		$validator = Validator::make(Input::all(), array(
			'name'        => array('required'),
			'description' => array('required', 'max:400'),
			'course'      => array('required'),
		));

		if($validator->valid())
		{
			$tutorial = new Tutorial(array(
				'tutor_id'    => Auth::user()->id,
				'course_id'   => Input::get('course'),
				'name'        => Input::get('name'),
				'description' => Input::get('description'),
				'likes'       => 0,
			));

			if($tutorial->save())
			{
				$this->get_join($tutorial->id);

				return Redirect::to('profile');
			}

			else
			{
				Input::flash();

				return Redirect::to('create')->with_errors(new Laravel\Messages('Error.'));
			}
		}

		else
		{
			Input::flash();

			return Redirect::to('create')->with_errors($validator->errors);
		}
	}

	/**
	 * Show the form to find a course.
	 *
	 * @return void
	 */
	public function get_find()
	{
		$this->layout->title = 'Search';
		$this->layout->content = View::make('tutorial.find');
	}

	/**
	 * Find a course.
	 *
	 * @return void
	 */
	public function post_find()
	{
		$courses = Course::with(array('tutorials', 'tutorials.tutor'))->where('name', 'LIKE', '%'.Input::get('course').'%')->get();

		$this->layout->title = 'Courses';
		$this->layout->content = View::make('tutorial.courses', compact('courses'));
	}

	/**
	 * List all tutorials.
	 *
	 * @param  int   $course
	 * @return void
	 */
	public function get_tutorials($course)
	{
		$tutorials = Tutorial::with('tutor')
						->where_course_id($course)
						->order_by('likes', 'desc')
						->take(100)
						->get();

		$this->layout->title = 'Tutorials';
		$this->layout->content = View::make('tutorial.tutorials', compact('tutorials'));
	}

	/**
	 * Display a tutorial.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_tutorial($id)
	{
		$tutorial = Tutorial::with(array('tutor', 'course'))->where_id($id)->first();

		$this->layout->title = ucwords($tutorial->name);
		$this->layout->content = View::make('tutorial.tutorial', compact('tutorial'));
	}

	/**
	 * Join a tutoring session.
	 *
	 * @param  int      $id
	 * @return Redirect
	 */
	public function get_join($id)
	{
		$tutorial = Tutorial::where_id($id)->first();

		if(is_null($tutorial))
		{
			return Redirect::home();
		}

		else
		{
			DB::table('pupils')->insert(array(
				'user_id'     => Auth::user()->id,
				'tutor_id'    => $tutorial->tutor->id,
				'course_id'   => $tutorial->course->id,
				'tutorial_id' => $tutorial->id,
			));

			return Redirect::to('profile');
		}

		return Redirect::home();
	}

	/**
	 * Like a tutoring session.
	 *
	 * @param  int       id
	 * @return Redirect
	 */
	public function get_like($id)
	{
		$tutorial = Tutorial::find($id);

		if( ! is_null($tutorial))
		{
			$tutorial->likes++;

			$tutorial->save();
		}

		return Redirect::to('tutorial/'.$id);
	}
}
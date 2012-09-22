<?php

class User_Controller extends Base_Controller {

	/**
	 * Set the correct filters to prevent guests from running amok.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->filter('before', 'guest')->only(array('register', 'login'));
		$this->filter('before', 'auth')->only(array('index', 'logout'));
	}

	/**
	 * Show the profile page.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$this->layout->title = 'Welcome Back, ' . Auth::user()->name;
		$this->layout->content = View::make('user.index');
	}

	/**
	 * Show the register form.
	 *
	 * @return void
	 */
	public function get_register()
	{
		$this->layout->title = 'Register';
		$this->layout->content = View::make('user.register');
	}

	/**
	 * Register the user.
	 *
	 * @return void
	 */
	public function post_register()
	{
		$form = Validator::make(Input::all(), array(
			'name'     => array('required'),
			'email'    => array('required', 'email', 'umemail', 'unique:users'),
			'password' => array('required', 'confirmed'),
		));

		if($form->valid())
		{
			$user = new User(array(
				'name'     => Input::get('name'),
				'email'    => Input::get('email'),
				'password' => Input::get('password'),
			));

			if($user->save())
			{
				Auth::login($user->id);

				return Redirect::to('profile');
			}

			else
			{
				Input::flash();

				return Redirect::to('register')->with_errors(new Laravel\Messages('Something went wrong.'));
			}
		}

		else
		{
			Input::flash();

			return Redirect::to('register')->with_errors($form->errors);
		}
	}

	/**
	 * Show the login form.
	 *
	 * @return void
	 */
	public function get_login()
	{
		$this->layout->title = 'Login';
		$this->layout->content = View::make('user.login');
	}

	/**
	 * Login the user.
	 *
	 * @return void
	 */
	public function post_login()
	{
		$form = Validator::make(Input::all(), array(
			'email'    => array('required', 'email', 'umemail'),
			'password' => 'required',
		));

		if($form->valid())
		{
			$user = array(
				'username' => Input::get('email'),
				'password' => Input::get('password'),
			);

			if(Auth::attempt($user))
			{
				return Redirect::to('profile');
			}

			else
			{
				Input::flash();

				return Redirect::to('login')->with_errors(new Laravel\Messages('Invalid email or password combination.'));
			}
		}

		else
		{
			Input::flash();

			return Redirect::to('login')->with_errors($form->errors);
		}
	}

	/**
	 * View a user's information.
	 *
	 * @param  int   $user
	 * @return void
	 */
	public function get_view($user)
	{
		$user = User::find($user);

		if(is_null($user))
		{
			return Redirect::home();
		}

		$this->layout->title   = $user->name;
		$this->layout->content = View::make('user.view', compact('user'));
	}

	/**
	 * Log the user out.
	 *
	 * @return void
	 */
	public function get_logout()
	{
		Auth::logout();

		return Redirect::to('login');
	}
}
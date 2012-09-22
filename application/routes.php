<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::any('register', 'user@register');
Route::any('login', 'user@login');
Route::get('profile', 'user@index');
Route::get('user/(:num)', 'user@view');
Route::get('logout', 'user@logout');

Route::get('tutorials', 'tutorial@index');
Route::any('create', 'tutorial@create');
Route::any('find', 'tutorial@find');
Route::get('course/(:num)', 'tutorial@tutorials');
Route::get('tutorial/(:num)', 'tutorial@tutorial');
Route::get('tutorial/(:num)/join', 'tutorial@join');
Route::get('tutorial/(:num)/like', 'tutorial@like');

/*
Route::any('api/user/(:num)', 'api@user');
Route::any('api/tutoring_session/(:num)', 'api@tutoring_session');
*/

Route::any('api/user/(:num)', function()
{
	$user = User::with('tutorials')
				->where_id($id)
				->first(array('id', 'email', 'name', 'likes', 'created_at', 'updated_at'))
				->to_array();

	return json_encode($user);

});

Route::any('api/course/(:any)', function($name)
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
});

Route::controller(Controller::detect());
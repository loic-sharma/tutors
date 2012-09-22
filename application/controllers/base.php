<?php

class Base_Controller extends Controller {

	/**
	 * Make all routes RESTful.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * Set the default layout for the app.
	 *
	 * @var string
	 */
	public $layout = 'layouts.main';

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}
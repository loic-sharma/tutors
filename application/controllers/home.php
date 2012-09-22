<?php

class Home_Controller extends Base_Controller {

	/**
	 * The home page.
	 *
	 * @return Redirect
	 */
	public function get_index()
	{
		return Redirect::to('profile');
	}

}
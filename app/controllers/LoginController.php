<?php

class LoginController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('login');
	}

        /**
     * Logging in, and returning at view based on the validation
     *
     * @return Response
     */
        public function login() 
        {
        	$validator = Validator::make(Input::all(), array('email' => 'required|email', 'password' => 'required'));
        	
        	if ($validator->fails()) {
        		return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
        	} else {
        		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
        			Session::flash('status', 'success');
        			Session::flash('message', 'Successfully logged in!');
        			return Redirect::intended('/uploader');
        		} else {
        			Session::flash('status', 'danger');
        			Session::flash('message', 'Incorrect login details!');
        			return Redirect::to('login');
        		}
        	}
        }
        
    /**
     * Logout and then displaying login
     *
     * @return Response
     */
    public function logout() 
    {
    	Auth::logout();
        return Redirect::to('/');
    }

}
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
                return Response::json([
                    'flash' => 'Validation failed', 'errors' => $validator],
                401
            );
        	} else {
        		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
        			return Redirect::intended('/uploader');
        		} else {
        			return Response::json([
                    'flash' => 'Authentication failed'],
                401
            );
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
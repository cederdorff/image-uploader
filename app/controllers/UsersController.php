<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(User::get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
    	$input = Input::all();

    	$v = Validator::make($input, User::$rules);

    	if ($v->fails()) {
    		return Response::json(array('success' => false, 'message' => $v->messages()->toArray()));
    	} else {
    		$user = new user;
    		$user->name = Input::get('name');
    		$user->email = Input::get('email');
    		$user->password = Hash::make(Input::get('password'));
    		$user->save();
    		return Response::json(array('success' => true, 'message' => 'New user created!'));
    	}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
    	$v = Validator::make(Input::all(), User::$rules);

    	if ($v->passes()) {
    		$user = User::find($id);
    		$user->name = Input::get('name');
    		$user->email = Input::get('email');
    		$user->password = Hash::make(Input::get('password'));
    		$user->save();
    		return Response::json(array('success' => true));
    	} else {
    		return Response::json(array('success' => false, 'message' => $v->messages()->toArray()));
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
    	User::destroy($id);
    	return Response::json(array('success' => true));
    }

        /**
     * Displaying login
     *
     * @return Response
     */
        public function showLogin() {
        	return View::make('login');
        }

    /**
     * Logging in, and returning at view based on the validation
     *
     * @return Response
     */
    public function login() {
    	$validator = Validator::make(Input::all(), array('email' => 'required|email', 'password' => 'required'));

    	if ($validator->fails()) {
    		return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
    	} else {
    		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
    			Session::flash('status', 'success');
    			Session::flash('message', 'Successfully logged in!');
    			return Redirect::to('uploader');
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
    public function logout() {
    	Auth::logout();
        Response::redirect('admin');
    }

}
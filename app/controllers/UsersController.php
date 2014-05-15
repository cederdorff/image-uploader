<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return Response::json(array('users'=>User::get()->toArray(), 'authUser' => Auth::user()->toArray()));
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

}
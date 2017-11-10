<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Country;

use DB;
use Mail;
use App\GetCountries;

class UserController extends Controller
{
    //
	use GetCountries;

    /**
     * Bedroom type display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

	    $users = User::with(['roles' => function($q){
					    $q->select('name');
					}])->get();

	    if ($users->isEmpty()) {
	        return view('admin.user.index', ['users' => null]);
	    } 

	    return view('admin.user.index', ['users' => $users]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  
        $roles = Role::orderBy('name')
            ->lists('name','id')->toArray();

        $countries = $this->Countries();

        return view('admin.user.create')
        							->with(compact('roles'))
        							->with(compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',	
            'country_id' => 'required|integer',
            'role_id' => 'required|integer',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/user/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $users = new User;

        $users->first_name = $request->input('first_name');
        $users->last_name = $request->input('last_name');
        $users->email = $request->input('email');
        $users->country_id = $request->input('country_id');
        $users->password = bcrypt($request->input('password'));


        if (! $users->save()) {
            abort(500, 'Add record failed');
        } else {

        	$user_role = $users->assignRole($request->input('role_id'));

        	if ($user_role) {

                // send email to new user
                Mail::send('emails.verify-email', ['users' => $users, 'url' => env('APP_URL')], function ($msg) use ($users) {

                    $sender = env('EMAIL_SENDER');

                    $msg->from($sender, 'BaliHomeParadise Verification');
                    $msg->to($users->email, $users->first_name)->subject('Please verify your email address');
                
                });

                // return response()->json(['data' => 'User Added!', 'status' => 1, 'type' => 'buyer']);
                $request->session()->flash('message', 'User added!');
            	return redirect(env('ADMIN_URL').'/user');

            } else {

                User::destroy($users->id);
                // return response()->json(['data' => 'Failed', 'status' => 0]);
                $request->session()->flash('message', 'Failed!');
            	return redirect(env('ADMIN_URL').'/user');

            }

            // $request->session()->flash('message', 'User added!');
            // return redirect(env('ADMIN_URL').'/user');
        }

    }

     /**
     * Show the form for editing Settings.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $users = User::findOrFail($id);
        $users = User::with(['roles' => function($q){
					    $q->select('id');
					}])->where('id', $id)->get();

        foreach ($users as $user) {
        	foreach ($user->roles as $role) 
        	{
        		$role_id = $role->id;					
        	}
        	$users_arr = array(
        		'id' => $user->id,
        		'first_name' => $user->first_name,
        		'last_name' => $user->last_name,
        		'email' => $user->email,
        		'country_id' => $user->country_id,
        		'role_id' => $role_id
        		);
        }

        $countries = $this->Countries();

        $roles = Role::orderBy('name')
            ->lists('name','id')->toArray();
             
        return view('admin.user.edit', compact('users_arr', 'countries', 'roles'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	$user = User::findOrFail($id);

    	if ($request->input('password') != null || $request->input('password') != '') {

    		$rules = array(
    			'first_name' => 'required|string|max:255',
	            'email' => 'required|email|unique:users,email,'.$user->id,	
	            'country_id' => 'required|integer',
	            'role_id' => 'required|integer',
	            'password' => 'required|min:6|confirmed',
	            'password_confirmation' => 'required|min:6'
    			);
    	} else {
    		$rules = array(
    			'first_name' => 'required|string|max:255',
	            'email' => 'required|email|unique:users,email,'.$user->id,	
	            'country_id' => 'required|integer',
	            'role_id' => 'required|integer'
    			);
    	}

    	$validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/user/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        if ($request->input('password') != null || $request->input('password') != '') {
        	$user->password = bcrypt($request->input('password'));
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->country_id = $request->input('country_id');
        
        if (!$user->update()) {
            abort(500, "Saving failed");
        } else {
            // $request->session()->flash('message', 'Record updated!');
            // return redirect(env('ADMIN_URL').'/area');
            DB::table('role_user')->where('user_id', '=', $id)->delete();
            
            $user_role = $user->assignRole($request->input('role_id'));

        	if ($user_role) {

                // return response()->json(['data' => 'User Added!', 'status' => 1, 'type' => 'buyer']);
                $request->session()->flash('message', 'User updated!');
            	return redirect(env('ADMIN_URL').'/user');

            } else {

                // return response()->json(['data' => 'Failed', 'status' => 0]);
                $request->session()->flash('message', 'Failed!');
            	return redirect(env('ADMIN_URL').'/user');

            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        
        if (!$user->delete()) {
            abort(500, 'Delete failed');
        } else {
            $request->session()->flash('message', 'User deleted!');
            return redirect(env('ADMIN_URL').'/user');
        }

        $request->session()->flash('message', 'Delete user failed!');
        return redirect(env('ADMIN_URL').'/user');

    }
}
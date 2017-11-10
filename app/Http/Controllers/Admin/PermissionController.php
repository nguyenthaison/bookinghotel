<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Permission;

class PermissionController extends Controller
{
    //

    /**
     * Bedroom type display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $permissions = Permission::all();

        if ($permissions->isEmpty()) {
            return view('admin.permission.index', ['permissions' => null]);
        } 

        return view('admin.permission.index', ['permissions' => $permissions]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
        return view('admin.permission.create');
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
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/permission/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $permission = new Permission;

        $permission->name = str_slug($request->input('name'), '-');
        $permission->label = $request->input('label');

        if (! $permission->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Permission added!');
            return redirect(env('ADMIN_URL').'/permission');
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

        $permissions = Permission::findOrFail($id);;
        return view('admin.permission.edit', ['permissions' => $permissions]);
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
        //
        
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,'. $permission->id,
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/permission/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $permission->name = str_slug($request->input('name'), '-');
        $permission->label = $request->input('label');

        if (!$permission->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/permission');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $permission = Permission::find($id);
        
        if (!$permission->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/permission')->with('message', 'Record delete!');
        }
    }
}

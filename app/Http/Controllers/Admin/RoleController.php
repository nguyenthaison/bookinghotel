<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Permission;

class RoleController extends Controller
{
    //

	/**
     * Bedroom type display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $roles = Role::all();

        if ($roles->isEmpty()) {
            return view('admin.role.index', ['roles' => null]);
        } 

        return view('admin.role.index', ['roles' => $roles]);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
        return view('admin.role.create');
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
            'name' => 'required|string|max:255|unique:roles',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/role/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $role = new Role;

        $role->name = $request->input('name');
        $role->label = !empty($request->input('label')) ? $request->input('label') : null;
        // $role->description = !empty($request->input('description')) ? $request->input('description') : null;

        if (! $role->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Role added!');
            return redirect(env('ADMIN_URL').'/role');
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

        $roles = Role::findOrFail($id);;
        return view('admin.role.edit', ['roles' => $roles]);
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
        
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,'. $role->id,
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/role/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $role->name = $request->name;
        $role->label = !empty($request->input('label')) ? $request->input('label') : null;

        if (!$role->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/role');
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
        $role = Role::find($id);
        
        if (!$role->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/role')->with('message', 'Record delete!');
        }
    }

    /**
     * Admin / Assignment Permissions > List of all roles
     *
     * @return \Illuminate\Http\Response 
     */
    public function listRoles ()
    {
        $roles = Role::all();

        if (!$roles->isEmpty()) {
            return view('admin.assignment.index')->with('roles', $roles);
        }
    }

    /**
     * Admin / Assignment Permissions > list of all Permissions of a role
     *
     * @return \Illuminate\Http\Response JSON
     */
    public function getPermissions ($id)
    {
        $role_permissions = Role::find($id)
                        ->permissions()
                        ->get(['id', 'name'])
                        ->toArray();
        
        $role = Role::find($id)->toArray();
        $permissions = Permission::all(['id', 'name', 'label'])->toArray();
        
        // dd(array_flatten($role_permissions));
        foreach ($permissions as $key => $value)
        {
            if (in_array($value['name'], array_flatten($role_permissions)))
            {
                $permissions[$key]['active'] = true;
            } else {
                $permissions[$key]['active'] = false;
            }
        }
        return view('admin.assignment.assign')
                ->with(compact('role'))
                ->with(compact('permissions'));
    }

    /**
     * Delete from permission_role by role_id, then
     * Store assigned permissions to a role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermissions(request $request)
    {

        $detach = Role::find($request->role_id)
                    ->permissions()
                    ->detach();

        $role = Role::find($request->role_id);

        foreach ($request->permissions as $key => $value) {
            
          $permissions = Permission::find($value);
          $attach = $role->givePermissionTo($permissions);
        
        }
        if (count($attach)) {
            return redirect(env('ADMIN_URL').'/assignment')->with('message', 'Permissions Assigned!');
        }
    }

    
}

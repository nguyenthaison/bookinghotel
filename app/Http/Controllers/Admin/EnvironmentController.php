<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Environment;

class EnvironmentController extends Controller
{
    //

    /**
     * Environment type display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $environments = Environment::all();

        if ($environments->isEmpty()) {
            return view('admin.environment.index', ['environments' => null]);
        } 

        return view('admin.environment.index', ['environments' => $environments]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
        return view('admin.environment.create');
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
            'title' => 'required|string|max:255|unique:environments',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/environment/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $environment = new Environment;

        $environment->title = $request->input('title');
        $environment->slug = str_slug($request->input('title'), '-');
        $environment->description = !empty($request->input('description')) ? trim($request->input('description')) : null;

        if (! $environment->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Environment added!');
            return redirect(env('ADMIN_URL').'/environment');
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

        $environments = Environment::findOrFail($id);;
        return view('admin.environment.edit', ['environments' => $environments]);
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
        
        $environment = Environment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:bedrooms,title,'.$environment->id,
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/environment/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $environment->title = $request->title;
        $environment->slug = str_slug($request->title, '-');
        $environment->description = $request->description;
       
        if (!$environment->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/environment');
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
        $environment = Environment::findOrFail($id);
        $environmentName = $environment->title;
        
        if (!$environment->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/environment')->with('message', $environmentName.' has been delete!');
        }
    }

    /**
     * Admin API > Get a record from Environment
     *
     * @return \Illuminate\Http\Response
     */

    public function getApiEnvironment()
    {   
        $environment = Environment::all();
        
        return response()->json($environment);
    }
}

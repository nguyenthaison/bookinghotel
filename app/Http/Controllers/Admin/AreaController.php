<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Area;
use App\Region;

class AreaController extends Controller
{
    //
    /**
     * Bedroom type display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $areas = Area::with('region')->get();

        if ($areas->isEmpty()) {
            return view('admin.area.index', ['areas' => null]);
        } 

        return view('admin.area.index', ['areas' => $areas]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  
        $regions = Region::orderBy('title')
            ->lists('title','id')->toArray();

        return view('admin.area.create', compact('regions'));
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
            'title' => 'required|string|max:255|unique:areas',
            'region_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/area/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $area = new Area;

        $area->title = $request->input('title');
        $area->slug = str_slug($request->input('title'), '-');
        $area->region_id = $request->input('region_id');
        $area->description = $request->input('description');
        $area->longitude = $request->input('longitude');
        $area->latitude = $request->input('latitude');

        if (! $area->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Area added!');
            return redirect(env('ADMIN_URL').'/area');
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

        $areas = Area::findOrFail($id);
        
        $regions = Region::orderBy('title')
            ->lists('title','id')->toArray();
            
        return view('admin.area.edit', compact('areas', 'regions'));
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
        
        $area = Area::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:areas,title,'.$area->id,
            'region_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/area/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $area->title = $request->title;
        $area->slug = str_slug($request->title, '-');
        $area->region_id = $request->region_id;
        $area->description = $request->input('description');
        $area->longitude = $request->input('longitude');
        $area->latitude = $request->input('latitude');       

        if (!$area->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/area');
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
        $area = Area::findOrFail($id);
        $areaName = $area->title;
        
        if (!$area->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/area')->with('message', $areaName.' has been delete!');
        }
    }

    /**
     * Admin API > Get a record from Area
     *
     * @return \Illuminate\Http\Response
     */

    public function getApiArea()
    {   
        $area = Area::all();
        
        return response()->json($area);
    }
}

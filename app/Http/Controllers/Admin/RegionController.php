<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Region;
use App\Country;

use App\GetCountries;

class RegionController extends Controller
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
	    $regions = Region::with('country')->get();

	    if ($regions->isEmpty()) {
	        return view('admin.region.index', ['regions' => null]);
	    } 

	    return view('admin.region.index', ['regions' => $regions]);
	}

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  
        $countries = $this->Countries();

        return view('admin.region.create', compact('countries'));
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
            'title' => 'required|string|max:255|unique:regions',
            'country_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/region/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $region = new Region;

        $region->title = $request->input('title');
        $region->slug = str_slug($request->input('title'), '-');
        $region->country_id = $request->input('country_id');

        if (! $region->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Region added!');
            return redirect(env('ADMIN_URL').'/region');
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

        $regions = Region::findOrFail($id);
        $countries = $this->Countries();
        
        return view('admin.region.edit', compact('regions', 'countries'));
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
        
        $region = Region::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:regions,title,'.$region->id,
            'country_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/region/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $region->title = $request->title;
        $region->slug = str_slug($request->title, '-');
        $region->country_id = $request->country_id;       

        if (!$region->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/region');
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
        $region = Region::findOrFail($id);
        $regionName = $region->title;
        
        if (!$region->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/region')->with('message', $regionName.' has been delete!');
        }
    }

    /**
    * Show list of countries.
    *
    * @return JSON countries list
    */
    public function apiCountries()
    {
        $countries = $this->Countries();
        return response()->json($countries);
    }

}

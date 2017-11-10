<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;

class CountryController extends Controller
{
    //

    /**
     * Country list display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $countries = Country::all();

        if ($countries->isEmpty()) {
            return view('admin.country.index', ['countries' => null]);
        } 

        return view('admin.country.index', ['countries' => $countries]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view('admin.country.create');

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
            'name' => 'required|string|max:255|unique:countries',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/country/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $country = new Country;

        $country->name = $request->input('name');
        $country->slug = str_slug($request->input('name'), '-');

        if (! $country->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Country added!');
            return redirect(env('ADMIN_URL').'/country');
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

        $countries = Country::findOrFail($id);;
        return view('admin.country.edit', ['countries' => $countries]);
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
        
        $country = Country::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:countries',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/country/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $country->name = $request->name;
        $country->slug = str_slug($request->name, '-');
       
        if (!$country->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/country');
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
        $country = Country::findOrFail($id);
        $countryName = $country->name;
        
        if (!$country->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/country')->with('message', $countryName.' has been delete!');
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

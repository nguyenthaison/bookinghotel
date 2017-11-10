<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// Init Model
use App\Bedroom;

class BedroomController extends Controller
{
    
    /**
     * Bedroom type display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $bedrooms = Bedroom::all();

        if ($bedrooms->isEmpty()) {
            return view('admin.bedroom.index', ['bedrooms' => null]);
        } 

        return view('admin.bedroom.index', ['bedrooms' => $bedrooms]);
        
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
        return view('admin.bedroom.create');
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
            'title' => 'required|string|max:255|unique:bedrooms',
            'number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/bedroom/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $bedroom = new Bedroom;

        $bedroom->title = $request->input('title');
        $bedroom->slug = str_slug($request->input('title'), '-');
        $bedroom->number = $request->input('number');

        if (! $bedroom->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Bedroom added!');
            return redirect(env('ADMIN_URL').'/bedroom');
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

        $bedrooms = Bedroom::findOrFail($id);;
        return view('admin.bedroom.edit', ['bedrooms' => $bedrooms]);
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
        // $method = $request->method();

        // if ($request->isMethod('put')) {
        //     dd('edit');
        // }
        $bedroom = Bedroom::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:bedrooms,title,'. $bedroom->id,
            'number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/bedroom/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        // $bedroom = Bedroom::findOrFail($id);

        $bedroom->title = $request->title;
        $bedroom->slug = str_slug($request->title, '-');
        $bedroom->number = $request->number;
        // $bedroom->update($request->all());
       

        if (!$bedroom->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/bedroom');
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
        $bedroom = Bedroom::findOrFail($id);
        $bedroomName = $bedroom->title;
        
        if (!$bedroom->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/bedroom')->with('message', $bedroomName.' has been delete!');
        }
    }

    /**
     * Admin API > Get a record from Bedroom
     *
     * @return \Illuminate\Http\Response
     */

    public function getApiBedroom()
    {   
        $bedroom = Bedroom::all();
        
        return response()->json($bedroom);
    }

    /**
     * Check if bedroom exist
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function isExist($title)
    {
       
        $getBedroom = Bedroom::where('title', '=', $title)->get();

        if ($getBedroom->isEmpty()) {
            return response()->json(['error' => false, 'exist' => false]);
        }

        return response()->json(['error' => true, 'exist' => true]);
    }


}

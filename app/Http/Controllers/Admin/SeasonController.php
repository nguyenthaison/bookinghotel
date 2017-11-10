<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Season;

class SeasonController extends Controller
{
    //

    /**
     * Season display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $seasons = Season::all();

        if ($seasons->isEmpty()) {
            return view('admin.season.index', ['seasons' => null]);
        } 

        return view('admin.season.index', compact('seasons'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
        return view('admin.season.create');
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
            'title' => 'required|string|max:255|unique:seasons',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/season/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $season = new Season;

        $season->title = $request->input('title');
        $season->slug = str_slug($request->input('title'), '-');

        if (! $season->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Season added!');
            return redirect(env('ADMIN_URL').'/season');
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

        $seasons = Season::findOrFail($id);;
        return view('admin.season.edit', compact('seasons'));
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
       
        $season = Season::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:seasons,title,'.$season->id
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/season/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $season->title = $request->title;
        $season->slug = str_slug($request->title, '-');

        if (!$season->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/season');
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
        $season = Season::findOrFail($id);
        $seasonName = $season->title;
        
        if (!$season->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/season')->with('message', $seasonName.' has been delete!');
        }
    }

    /**
     * Admin API > Get a record from Season
     *
     * @return \Illuminate\Http\Response
     */

    public function getApiSeason()
    {   
        $season = Season::orderBy('id', 'asc')->get(['id', 'title']);

        $numSeasons = Season::count();

        $result = array('season' => $season, 'numseasons' => $numSeasons);

        
        return response()->json($result);
    }
}

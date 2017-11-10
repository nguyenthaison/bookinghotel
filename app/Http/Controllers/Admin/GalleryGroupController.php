<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GalleryGroup;

class GalleryGroupController extends Controller
{
    //

    /**
     * Gallery Group display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $GalleryGroups = GalleryGroup::all();

        if ($GalleryGroups->isEmpty()) {
            return view('admin.gallery-group.index', ['GalleryGroups' => null]);
        } 

        return view('admin.gallery-group.index', compact('GalleryGroups'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
        return view('admin.gallery-group.create');
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
            'title' => 'required|string|max:255|unique:gallery_groups',
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/gallery-group/create')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $GalleryGroup = new GalleryGroup;

        $GalleryGroup->title = $request->input('title');

        if (! $GalleryGroup->save()) {
            abort(500, 'Add record failed');
        } else {

            $request->session()->flash('message', 'Gallery Group added!');
            return redirect(env('ADMIN_URL').'/gallery-group');
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

        $GalleryGroups = GalleryGroup::findOrFail($id);;
        return view('admin.gallery-group.edit', compact('GalleryGroups'));
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
       
        $GalleryGroup = GalleryGroup::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:gallery_groups,title,'.$GalleryGroup->id
        ]);

        if ($validator->fails()) {
            return redirect(env('ADMIN_URL').'/gallery-group/'.$request->id.'/edit')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $GalleryGroup->title = $request->title;

        if (!$GalleryGroup->update()) {
            abort(500, "Saving failed");
        } else {
            $request->session()->flash('message', 'Record updated!');
            return redirect(env('ADMIN_URL').'/gallery-group');
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
        $GalleryGroup = GalleryGroup::findOrFail($id);
        $GalleryGroupName = $GalleryGroup->title;
        
        if (!$GalleryGroup->delete()) {
            abort(500, 'Delete failed');
        } else {
            return redirect(env('ADMIN_URL').'/gallery-group')->with('message', $GalleryGroupName.' has been delete!');
        }
    }

    /**
     * Admin API > Get a record from Gallery Group
     *
     * @return \Illuminate\Http\Response
     */

    public function getApiGalleryGroup()
    {   
        $GalleryGroup = GalleryGroup::orderBy('title', 'asc')->get(['id', 'title']);
        
        return response()->json($GalleryGroup);
    }
}

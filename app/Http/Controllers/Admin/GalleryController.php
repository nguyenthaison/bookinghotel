<?php

namespace App\Http\Controllers\Admin;

use Validator;
use File;
use Storage;
use Image;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Gallery;
use App\Villa;
use App\GalleryGroup;

class GalleryController extends Controller
{
    //
    protected $wThumb_admin = 220;
    protected $hThumb_admin = 100;
    protected $max_width = 720;
    protected $max_height = 480;


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $result = null;        
        
        $villa = Villa::findOrFail($request->id);

        $ImageName = $villa->slug . '-' . str_random(5);
 
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $upload = Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));


        if ($upload) {    
            
            $gallery = new Gallery;


            $gallery->villa_id = $request->id;
            $gallery->group_id = $request->group_id;
            $gallery->image = $file->getFilename().'.'.$extension;
            $gallery->original_name = $ImageName.'.'.$extension;
            $gallery->mime = $file->getClientMimeType();
            $gallery->main_image = $request->main_image == 'true' ? 1 : 0;

            // $gallery->gallery = $ImageName . '.jpg';
            $gallery->caption = $request->caption;

            if (!$gallery->save()) {

                return response()->json(['data' => 'failed', 'status' => 0]);
            
            } else {

                return response()->json(['data' => 'success', 'status' => 1]);
            }
        } else {

            return response()->json(['data' => 'failed', 'status' => 2]);
        }
    }


    public function thumbImages($original_name, $width = null, $height = null){
    
        $gallery = Gallery::where('original_name', '=', $original_name)->first();
        
        if ($gallery) {
            $prettyName = $gallery->original_name;

            if (Storage::disk('local')->exists($gallery->image))
            {

                $img = Image::cache(function($image) use($gallery, $width, $height) {
                    $image->make(Storage::disk('local')->get($gallery->image))->resize($width, null, 
                        function ($constraint) {
                            $constraint->aspectRatio();
                        })->crop(220,100);
                    }, true);

                return (new Response($img, 200))
                    ->header('Content-Type', $gallery->mime);
            }
        }

        abort(404, 'Image not found');


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
        
        $gallery = Gallery::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Group' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {
            $gallery->group_id = (int) $request->Group;
            $gallery->main_image = $request->MainImage == 'true' ? 1 : 0;
            $gallery->caption = $request->Caption;

            if (!$gallery->update()) {
                abort(500, "Saving failed");
            } else {
                return response()->json(['data' => 'Gallery Updated!', 'status' => 1]);
            }

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
        $gallery = Gallery::findOrFail($id);
        
        if (Storage::disk('local')->exists($gallery->image))
        {
            $delete = Storage::disk('local')->delete($gallery->image);

            if ($delete) {
                if (!$gallery->delete()) {
                    abort(500, 'Delete failed');
                } else {
                    return response()->json(['data' => 'Image Delete!', 'status' => 1]);
                }
            }
        }

        return response()->json(['data' => 'Failed', 'status' => 0]);
        
    }


    /**
     * Admin API > Get gallery list
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetGallery($id)
    {
        $results = array();
        
        $gallery = Gallery::where('villa_id', $id)->get();

        foreach ($gallery as $key => $value) {
            
            $path = route('thumbImages', [$value->original_name, 250]);
        
            $prettyName = $value->original_name;

            $results[] = array(
                            'id' => $value->id, 
                            'villa_id' => $value->villa_id,
                            'caption' => $value->caption,
                            'group_id' => $value->group_id,
                            'main_image' => $value->main_image,
                            'path' => $path
                            );
        }

        return response()->json($results);
    }
}

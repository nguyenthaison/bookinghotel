<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use File;
use Storage;
use Image;
use DB; 
use App\Villa;
use App\Gallery;
use App\Testimonial;
use App\Area;
use App\Bedroom;


class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    protected $thumbHomeWidth = 303;
    protected $thumbHomeHeight = 180;

    protected $thumbDetailWidth = 210;
    protected $thumbDetailHeight = 115;

    protected $thumbGalleryWidth = 80;
    protected $thumbGalleryHeight = 80;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $featuredVillas = Villa::where('featured', 1)
                    ->where('status', 1)
                    ->with(['area' => function($query) {
                        $query->select('id', 'slug');
                    }])
                     ->with(['environment' => function($query) {
                        $query->select('id', 'title');
                    }])
                    ->with(['gallery' => function($query) {
                        $query->select('villa_id', 'group_id', 'image', 'original_name', 'caption')
                              ->where('main_image', 1);
                    }])
                    ->with(['review' => function($query) {
                        $query->select('villa_id');
                    }])
                    ->with(['rate' => function($query) {
                        $query->select(DB::raw('MIN(rate) as min_rate, villa_id'));
                    }])
                    ->get(['id', 'area_id', 'title', 'slug', 'intro', 'bedrooms_no', 'environment_id', 'occupied_max']);

        //dd($featuredVillas);

        $testimonials = Testimonial::where('status', 'live')
                                ->with(['country' => function($query) {
                                    $query->select('id', 'name');
                                }])
                                ->get(['guest_name', 'comments', 'city', 'country_id']);

        $areas = Area::all();
        $bedrooms = Bedroom::all();
        
        return view('home', compact('featuredVillas', 'testimonials', 'areas', 'bedrooms'));
    }

    public function thumbnail($original_name, $width = null, $page_name ='', $height = null){
        
        $gallery = Gallery::where('original_name', '=', $original_name)->first();
        
        if (!empty($page_name) && $page_name === 'home') {
            
            $thumbWidth = $this->thumbHomeWidth;
            $thumbHeight = $this->thumbHomeHeight;
        
        } elseif (!empty($page_name) && $page_name === 'detail') {
            
            $thumbWidth = $this->thumbDetailWidth;
            $thumbHeight = $this->thumbDetailHeight;
        
        } elseif (!empty($page_name) && $page_name === 'gallery') {
            $thumbWidth = $this->thumbGalleryWidth;
            $thumbHeight = $this->thumbGalleryHeight;
        } else {
            $thumbWidth = 250;
            $thumbHeight = 100;
        }

        if ($gallery) {
            $prettyName = $gallery->original_name;

            if (Storage::disk('local')->exists($gallery->image))
            {

                $img = Image::cache(function($image) use($gallery, $width, $height, $thumbWidth, $thumbHeight) {
                    $image->make(Storage::disk('local')->get($gallery->image))->resize($width, null, 
                        function ($constraint) {
                            $constraint->aspectRatio();
                        })->crop($thumbWidth, $thumbHeight);
                    }, true);

                return (new Response($img, 200))
                    ->header('Content-Type', $gallery->mime);
            }
        }

        abort(404, 'Image not found');


    }

    
}

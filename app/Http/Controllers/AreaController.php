<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use File;
use Storage;
use Image;
use DB; 
use App\Area;
use App\Villa;
use App\Gallery;
use App\SpecialOffers;


class AreaController extends Controller
{
    //
    
    /**
     * Show the villa list by area.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($area)
    {
    	$area = Area::where('slug', $area)->get();
		//return $area[0]->title;
	    if ($area->isEmpty()) {

	        abort(404);

	    } else {
	    	
	    	$villas = Villa::where('area_id', $area[0]->id)
	    				->where('status', 1)
	                    ->with(['area' => function($query) {
	                        $query->select('id', 'slug', 'longitude', 'latitude');
	                    }])
	                    ->get([
	                    	'id', 
	                    	'area_id', 
	                    	'title', 
	                    	'longitude',
	                    	'latitude' 
	                    ]);

	        // $specialOffers = DB::table('special_offers')
	        // 					->leftJoin('villas', 'special_offers.villa_id', '=', 'villas.id')
	        // 					->leftJoin('galleries', 'villas.id', '=', 'galleries.villa_id')
	        // 					->leftJoin('areas', 'villas.area_id', '=', 'areas.id')
	        // 					->leftJoin('rates', 'villas.id', '=', 'rates.villa_id')
	        // 					->select('special_offers.*', 'villas.title as villa_title', 'villas.slug', 'areas.slug as area_slug', 'galleries.original_name',
	        // 						DB::raw('MIN(rates.rate) as min_rate')
	        // 						)
	        // 					->where('special_offers.period_end', '<=', $now)
	        // 					->where('galleries.main_image', '=', 1)
	        // 					->where('villas.status', '=', 1)
	        // 					->get();
	        $specialOffers = DB::table('special_offers')
	        					->leftJoin('villas', 'special_offers.villa_id', '=', 'villas.id')
	        					->leftJoin('galleries', 'villas.id', '=', 'galleries.villa_id')
	        					->leftJoin('areas', 'villas.area_id', '=', 'areas.id')
	        					->leftJoin('environments', 'villas.environment_id', '=', 'environments.id')
	        					->select('special_offers.*', 'villas.title as villa_title', 'villas.slug', 'areas.slug as area_slug', 'galleries.original_name', 'environments.title as environment_title'
	        						,'villas.bedrooms_no', 'villas.occupied_max')
	        					->whereDate('special_offers.period_end', '>=', date('Y-m-d').' 00:00:00')
	        					->where('galleries.main_image', '=', 1)
	        					->where('villas.status', '=', 1)
	        					->get();
			//var_dump($villas); exit;
	        return view('area', compact('villas', 'specialOffers', 'area'));

	    }
    }

    /**
     * Implements api villa list
     */
    public function apiGetVillaByArea($id)
    {
    	$villas = Villa::where('area_id', $id)
    					->where('status', 1)
	                    ->with(['area' => function($query) {
	                        $query->select('id', 'slug');
	                    }])
	                     ->with(['environment' => function($query) {
	                        $query->select('id', 'title');
	                    }])
	                    ->with(['gallery' => function($query) {
	                        $query->select('villa_id', 'original_name')
	                              ->where('main_image', 1);
	                    }])
	                    ->with(['review' => function($query) {
	                        $query->select('villa_id');
	                    }])
	                    ->with(['rate' => function($query) {
	                        $query->select(DB::raw('MIN(rate) as min_rate, villa_id'));
	                    }])
	                    ->get([
	                    	'id', 
	                    	'area_id', 
	                    	'title', 
	                    	'slug', 
	                    	'intro', 
	                    	'bedrooms_no', 
	                    	'environment_id', 
	                    	'occupied_max', 
	                    ]);
	    
	    if ($villas->isEmpty()) {
	    	return response()->json(['data' => 'failed', 'status' => 0]);
	    }
	    return response()->json($villas);
    }
}

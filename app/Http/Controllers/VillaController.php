<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use File;
use Storage;
use Image;
use DB;
use Mail;
use Validator; 
use App\Area;
use App\Villa;
use App\Gallery;
use App\SpecialOffers;

class VillaController extends Controller
{
    //
    public function index($slug1,$slug2)
    {

    	$slug2 = str_replace('.html', '', $slug2);

    	$area = Area::where('slug', $slug1)->get();

    	$villa = Villa::where('slug', $slug2)
    				->where('status', 1)
    				->where('area_id', $area[0]->id)
    				// ->with(['gallery' => function($query) {
	       //              $query->select('villa_id', 'image', 'original_name');
	       //          }])
	                ->with(['review' => function($query) {
	                        $query->select('villa_id', 'guest_name', 'comments');
	                }])
	                ->with(['rate' => function($query) {
	                        $query->select(
	                        	'rates.id as id_rate', 
	                        	'rates.villa_id',
	                        	'rates.min_stay',
	                        	'rates.tax',
	                        	'rates.plus',
	                        	'rates.rate',
	                        	'bedrooms.title as bedroom',
	                        	'seasons.title as season')
	                        ->join('bedrooms', 'rates.bedroom_id', '=', 'bedrooms.id')
	                        ->join('seasons', 'rates.season_id', '=', 'seasons.id')
	                        ->orderBy('rates.id','asc')
	                        ->orderBy('seasons.title', 'asc');
	                }])
	                ->with(['special_offers' => function($query) {
	                	$query->select(
	                		'id', 
	                		'title as SpecialOfferTitle',
	                		'discount',
	                		'villa_id')
	                		->whereDate('period_end', '>=', date('Y-m-d').' 00:00:00');
	                }])
	                ->get();
	    //dd($villa[0]->rate);
	    if ($villa->isEmpty()) {

	        abort(404);

	    } else {

	    	$similarVillas = Villa::where('area_id', $area[0]->id)
	    				->where('slug', '<>', $slug2)
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
	                    ->inRandomOrder()
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
	        
	        $ImageDetail = Gallery::where('villa_id', $villa[0]->id)
	        						->where('main_image', 1)
	        						->get();

	        if ($ImageDetail->isEmpty()) {
	        	$ImageDetail = array();
	        }

	        $rates = array();
	        foreach ($villa[0]->rate as $rate) {
	        	$bedroom = $rate->bedroom;
	        	if (isset($rates[$bedroom])) {
	        		$rates[$bedroom][] = $rate;
	        	} else {
	        		$rates[$bedroom] = array($rate);
	        	}
	        }

	     	return view('villa', compact('villa', 'similarVillas', 'area', 'ImageDetail', 'rates'));
	    }
	                
    }

    /**
     * Villa API > Get gallery by villa
     *
     * @return \Illuminate\Http\Response
     */
     public function apiGetGallery($id)
     {
     	$villaGallery = Gallery::where('villa_id', $id)->get(['image', 'original_name', 'caption']);

     	if ($villaGallery->isEmpty()) {
            return response()->json(['data' => 'Failed', 'status' => 0]);
     	}

     	return response()->json(['data' => $villaGallery, 'status' => 1]);
     }

    public function images($original_name, $width = null, $height = null)
    {
        $gallery = Gallery::where('original_name', '=', $original_name)->first();
        
        if ($gallery) {
            $prettyName = $gallery->original_name;

            if (Storage::disk('local')->exists($gallery->image))
            {

                $img = Image::cache(function($image) use($gallery, $width, $height) {
                    $image->make(Storage::disk('local')->get($gallery->image))->resize($width, null, 
                        function ($constraint) {
                            $constraint->aspectRatio();
                        })->crop(1280,400);
                    }, true);

                return (new Response($img, 200))
                    ->header('Content-Type', $gallery->mime);
            }
        }

        abort(404, 'Image not found');


    }

    public function getOriginalImages($original_name, $width = null, $height = null)
    {
        $gallery = Gallery::where('original_name', '=', $original_name)->first();
        
        if ($gallery) {
            $prettyName = $gallery->original_name;

            if (Storage::disk('local')->exists($gallery->image))
            {

                $img = Image::cache(function($image) use($gallery) {
                    $image->make(Storage::disk('local')->get($gallery->image))->resize(600, null, 
                        function ($constraint) {
                            $constraint->aspectRatio();
                        })->crop(600,400);
                    }, true);

                return (new Response($img, 200))
                    ->header('Content-Type', $gallery->mime);
            }
        }

        abort(404, 'Image not found');


    }

	public function Order(Request $request)
	{
		//$mail_addr =
		$user = array();
		$user['email'] = $request->input("user-email");
		$user['name'] = $request->input("user-name");
		$villa_id = $request->input("villa-id");
		$villa = Villa::find($villa_id)->first();
		
		$order_content = $villa->title."(".$villa_id.")"."%0D%0A"
						.$request->input("check-in")."~".$request->input("check-out")."%0D%0A"
						."Number Of Guests: ".$request->input("num-guest")."%0D%0A"
						."Number Of Child: ".$request->input("num-child")."%0D%0A";
		//var_dump($user); exit;
		//echo $order_content; exit;
		//$msg = "abcdeffedcba";
		Mail::send('emails.order-email', ['user' => $user, 'content' => $order_content], function ($msg) use($user) {

                    $sender = env('EMAIL_SENDER');

					$msg->from($sender, 'Order');
					$msg->to("asharp1024@hotmail.com")->subject('I want to order now.');
                
                });
		return view('order-success');
	}
}

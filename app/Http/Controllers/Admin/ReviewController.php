<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Review;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //

    /**
     * Reviews list display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $villas = Villa::with('area')->get();

        // if ($villas->isEmpty()) {
        //     return view('admin.villa.index', ['villas' => null, 'status' => $request->stat]);
        // } 

        // return view('admin.villa.index', ['villas' => $villas, 'status' => $request->stat]);
        return view('admin.reviews.index', ['status' => $request->stat]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (strtolower($request->Type) == 'manual') {
	        $validator = Validator::make($request->all(), [
	            'GuestName' => 'required|string|max:100',
	            'Email' => 'required|email',
                'Country_id' => 'required',
	            'Comments' => 'required'
	        ]);
	    } else {
	    	$validator = Validator::make($request->all(), [
	            'GuestName' => 'required|string|max:100',
	         	'Email' => 'required|email',
                'Country_id' => 'required'
	        ]);
	    }

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {

            $review = new Review;

            $review->villa_id = $request->VillaReviews['selected']['id'];
            $review->guest_name = $request->GuestName;
            $review->email = $request->Email;
            $review->city = !empty($request->City) ? $request->City : null;
            $review->country_id =  $request->Country_id;
            $review->comments = strtolower($request->Type) == 'manual' ? 
            						str_replace(PHP_EOL, '', $request->Comments) : null;
            
            $review->type = strtolower($request->Type);
            $review->arrival_date = $request->ArrivalDate ? $request->ArrivalDate : null;
            $review->exp_date = strtolower($request->Type) == 'auto' ? Carbon::now()->addMonths(2) : null;
            $review->token = strtolower($request->Type) == 'auto' ? str_random(20) : null;

            $review->status = strtolower($request->Type) == 'auto' ? 'send' : 'draft';

            $review->created_by = auth()->user()->id;

            if (!$review->save()) {
                abort(500);
                return response()->json(['data' => 'Failed', 'status' => 0]);
            } else {

                // send email to guest
                if (strtolower($request->Type) == 'auto') {

	                $send = Mail::send('emails.reviews-email', ['review' => $review, 'url' => env('APP_URL'), 'villa_name' => $request->VillaReviews['selected']['title']], function ($msg) use ($review) {

	                    $sender = env('BHP_EMAIL');

	                    $msg->from($sender, 'Bali Home Paradise');
	                    $msg->to($review->email, $review->guest_name)->subject('Please review the villa that you stay with us');
	                
	                });

	            }

                return response()->json(['data' => 'Content Added!', 'status' => 1]);

            }
        }
    }

    /**
     * Show the form for approve the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        //
        $review = Review::findOrFail($id);
        
        $review->status = 'live';

        if (!$review->update()) {
                abort(500, "Saving failed");
        } else {
        	return redirect('dashboard/reviews/?stat=2');


        	// return view('dashboard.reviews.index', ['status' => '2']);
        }

        // return view('admin.villa.edit', ['id' => $id]);
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
        $review = Review::findOrFail($id);
        
        if (!$review->delete()) {
            abort(500, 'Delete failed');
        } else {
            return response()->json(['data' => 'Review Delete!', 'status' => 1]);
        }

        return response()->json(['data' => 'Failed', 'status' => 0]);
    }

    /**
     * Admin API > Get reviews list
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetReviews()
    {
        $review = Review::with(['villa' => function($query) {
                            $query->select('id', 'title');
                        }])->get(['id', 'guest_name', 'arrival_date', 'status', 'villa_id']);

        return response()->json($review);
    }

    /**
     * Admin API > Get reviews by villa
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetReviewsByVilla($id)
    {
        $review = Review::where('villa_id', $id)
                        ->where('status', 'live')
                        ->with(['villa' => function($query)  {
                            $query->select('id');
                        }])
                        ->with(['country' => function($query) {
                            $query->select('id', 'name');
                        }])
                        ->get([
                                'id', 
                                'guest_name', 
                                'comments',
                                'villa_id', 
                                'city', 
                                'country_id'
                        ]);

        return response()->json(array('result' => $review, 'status' => 1));
    }
}

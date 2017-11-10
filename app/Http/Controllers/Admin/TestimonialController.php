<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Mail;

use App\Testimonial;
use Carbon\Carbon;

class TestimonialController extends Controller
{
    //
    /**
     * Testimonial list display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.testimonials.index', ['status' => $request->stat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        return view('admin.testimonials.create');
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
                'Country_id' => 'required',
	            'Comments' => 'required'
	        ]);
	    } else {
	    	$validator = Validator::make($request->all(), [
	            'GuestName' => 'required|string|max:100',
                'Country_id' => 'required'
	        ]);
	    }

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {

            $testimonial = new Testimonial;

            $testimonial->guest_name = $request->GuestName;
            $testimonial->city = !empty($request->City) ? $request->City : null;
            $testimonial->country_id =  $request->Country_id;
            $testimonial->comments = str_replace(PHP_EOL, '', $request->Comments);
            
            // $testimonial->exp_date = strtolower($request->Type) == 'auto' ? Carbon::now()->addMonths(2) : null;
            // $testimonial->token = strtolower($request->Type) == 'auto' ? str_random(20) : null;

            $testimonial->status = 'draft';

            $testimonial->created_by = auth()->user()->id;

            if (!$testimonial->save()) {
                abort(500);
                return response()->json(['data' => 'Failed', 'status' => 0]);
            } else {

             //    // send email to guest
             //    if (strtolower($request->Type) == 'auto') {

	            //     $send = Mail::send('emails.testimonials-email', ['testimonial' => $testimonial, 'url' => env('APP_URL'), 'villa_name' => $request->VillaReviews['selected']['title']], function ($msg) use ($review) {

	            //         $sender = env('BHP_EMAIL');

	            //         $msg->from($sender, 'Bali Home Paradise');
	            //         $msg->to($testimonial->email, $testimonial->guest_name)->subject('Please review the villa that you stay with us');
	                
	            //     });

	            // }

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
        $testimonial = Testimonial::findOrFail($id);
        
        $testimonial->status = 'live';

        if (!$testimonial->update()) {
                abort(500, "Saving failed");
        } else {
        	return redirect('dashboard/testimonial/?stat=2');


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
        $testimonial = Testimonial::findOrFail($id);
        
        if (!$testimonial->delete()) {
            abort(500, 'Delete failed');
        } else {
            return response()->json(['data' => 'Testimonial Delete!', 'status' => 1]);
        }

        return response()->json(['data' => 'Failed', 'status' => 0]);
    }

    /**
     * Admin API > Get reviews list
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetTestimonial()
    {
        $testimonial = Testimonial::get(['id', 'guest_name', 'status']);

        return response()->json($testimonial);
    }
}

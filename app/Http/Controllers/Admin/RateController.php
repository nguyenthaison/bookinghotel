<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rate;
use App\Bedroom;
use App\Season;

class RateController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
    	$validator = Validator::make($request->all(), [
            'Rate' => 'required|between:0,99.99',
            'Bedroom' => 'required',
            'VillaId'	=> 'required',
            'Season' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {

			if ($request->RateId > 0) {

	        		$rate = Rate::findOrFail($request->RateId);

	        		$rate->villa_id = (int)$request->VillaId;
		        	$rate->season_id = (int)$request->Season;
		        	$rate->bedroom_id = (int)$request->Bedroom;
		        	$rate->start_date = $request->StartDate;
		        	$rate->end_date = $request->EndDate;
		        	$rate->min_stay = $request->MinimumStay;
		        	$rate->tax = (float)$request->Tax;
		        	$rate->plus = $request->Plus == true ? 1 : 0;
		        	$rate->rate = (float)$request->Rate;
		        	$rate->created_by = 0;

		        	if (!$rate->update()) {
		                abort(500, "Saving failed");
		              	return response()->json(['data' => 'Update Failed', 'status' => 2]);

		            } else {

		            	return response()->json(['data' => 'Rate Updated!', 'status' => 4]);

		            }
	        	}
        	/*$check_rate = Rate::where('villa_id', (int)$request->VillaId)
        						->where('bedroom_id', (int)$request->Bedroom)
        						->where('season_id', (int)$request->Season)
        						->get();
        	
        	if ($check_rate->isEmpty()) {*/

	        	$rate = new Rate;

	        	$rate->villa_id = (int)$request->VillaId;
	        	$rate->season_id = (int)$request->Season;
	        	$rate->bedroom_id = (int)$request->Bedroom;
	        	$rate->start_date = $request->StartDate;
	        	$rate->end_date = $request->EndDate;
	        	$rate->min_stay = $request->MinimumStay;
	        	$rate->tax = (float)$request->Tax;
	        	$rate->plus = $request->Plus == true ? 1 : 0;
	        	$rate->rate = (float)$request->Rate;
	        	$rate->created_by = 0;

	        	if (!$rate->save()) {
	                abort(500);
	                return response()->json(['data' => 'Failed', 'status' => 2]);
	            } else {

	            	return response()->json(['data' => 'Rate Added!', 'status' => 1]);
	            
	            }
	       /* } else {
	        	// Edit Rate
	        	
	       		return response()->json(['data' => 'Record Exist', 'status' => 3]);

	        }*/
        }

    }


	function delrates(Request $request)
	{
		//return $request->RateId;
		//$selected_rate = Rate::find($request->RateId);
		Rate::destroy($request->RateId);
		return $request->RateId;
	}

   /**
     * Admin API > Get a record from Villa
     *
     * @return \Illuminate\Http\Response
     */
   public function apiGetVillaRates (Request $request, $id)
   {
   		
   		$rate_arr = array();

   		$rates = Rate::where('villa_id', $id)
   					 ->with('bedroom')
   					 ->with('season')
   					 ->get();

   		foreach ($rates as $keyRates => $valRates) {
   			$rate_arr[] = array(
   					'VillaId' => $valRates->villa_id,
   					'Bedroom' => (string)$valRates->bedroom_id,
   					'Season' => (string)$valRates->season_id,
   					'StartDate' => $valRates->start_date,
   					'EndDate' => $valRates->end_date,
   					'MinimumStay' => $valRates->min_stay,
   					'Tax' => $valRates->tax,
   					'Plus' => $valRates->plus == 1 ? true : false,
   					'Rate' => $valRates->rate,
   					'SeasonTitle' => $valRates->season->title,
   					'BedroomTitle' => $valRates->bedroom->title,
   					'RateId' => $valRates->id
   				);
   		}

   		return response()->json($rate_arr);
   }
}

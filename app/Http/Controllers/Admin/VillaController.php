<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Villa;
use App\Bedroom;
use App\Area;
use App\Environment;
use App\Gallery;
use App\SpecialOffers;

class VillaController extends Controller
{
    //

    /**
     * Villa list display.
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
        return view('admin.villa.index', ['status' => $request->stat]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $status = array('0' => 'Draft', '1' => 'Live');       
        return view('admin.villa.create', compact('status'));
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
            'Title' => 'required|string|max:100',//|unique:villas
            'Area' => 'required',
            'Environment' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {

            $villa = new Villa;

            $villa->status = $request->Status === 'draft' ? 0 : 1;
            $villa->title = $request->Title;
            $villa->slug = str_slug($request->Title, '-');
            $villa->area_id = $request->Area;
            $villa->intro = str_replace(PHP_EOL, '', $request->Intro);
            $villa->description = str_replace(PHP_EOL, '', $request->Description);
            $villa->services =  str_replace(PHP_EOL, '', $request->Services);
            $villa->facilities =  str_replace(PHP_EOL, '', $request->Facilities);
            $villa->staff_detail =  str_replace(PHP_EOL, '', $request->Staff_detail);
            $villa->term_condition =  str_replace(PHP_EOL, '', $request->Term_condition);
            $villa->longitude =  $request->Longitude;
            $villa->latitude =  $request->Latitude;
            $villa->occupied_max =  $request->Occupied_max;
            $villa->bedrooms_no =  $request->Bedrooms_no;
            $villa->staff_no =  $request->Staff_no;
            $villa->environment_id =  $request->Environment;
            $villa->created_by = auth()->user()->id;

           

            if (!$villa->save()) {
                abort(500);
                return response()->json(['data' => 'Failed', 'status' => 0]);
            } else {

                $villa = Villa::findOrFail($villa->id);
                // Insert videos

                if (!empty($request->multipleBedroom)) {

                    if (is_array($request->multipleBedroom)) {

                        foreach ($request->multipleBedroom as $key => $value) {
                            
                            $villa->bedrooms()->attach($value['id']);

                        }

                    } 

                }

                return response()->json(['data' => 'Content Added!', 'status' => 1]);

            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $villa = Villa::findOrFail($id);
        return view('admin.villa.edit', ['id' => $id]);
    }

     /**
     * Show the form for adding / editing rates.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rates($id)
    {
        //
        $villa = Villa::findOrFail($id);
        return view('admin.villa.rate', ['id' => $id]);
    }

     /**
     * Show the form for adding / editing gallery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gallery($id)
    {
        $villa = Villa::findOrFail($id);

        return view('admin.villa.gallery', ['id' => $id]);
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

        $villa = Villa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Title' => 'required|string|max:100|unique:villas,title,'. $villa->id,
            'Area' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {

            $villa->status = $request->Status === 'draft' ? 0 : 1;
            $villa->featured = $request->Featured === true ? 1 : 0;
            $villa->title = $request->Title;
            $villa->slug = str_slug($request->Title, '-');
            $villa->area_id = $request->Area;
            $villa->intro = str_replace(PHP_EOL, '', $request->Intro);
            $villa->description = str_replace(PHP_EOL, '', $request->Description);
            $villa->services =  str_replace(PHP_EOL, '', $request->Services);
            $villa->facilities =  str_replace(PHP_EOL, '', $request->Facilities);
            $villa->staff_detail =  str_replace(PHP_EOL, '', $request->Staff_detail);
            $villa->term_condition =  str_replace(PHP_EOL, '', $request->Term_condition);
            $villa->longitude =  $request->Longitude;
            $villa->latitude =  $request->Latitude;
            $villa->occupied_max =  $request->Occupied_max;
            $villa->bedrooms_no =  $request->Bedrooms_no;
            $villa->staff_no =  $request->Staff_no;
            $villa->environment_id =  $request->Environment;

            if (!$villa->update()) {
                abort(500, "Saving failed");
            } else {
                
                // remove all relationship
                $villa->bedrooms()->detach();

                if (!empty($request->multipleBedroom)) {

                    if (is_array($request->multipleBedroom)) {

                        foreach ($request->multipleBedroom as $key => $value) {
                            
                            $villa->bedrooms()->attach($value['id']);

                        }

                    } 

                }

                return response()->json(['data' => 'Content Updated!', 'status' => 1]);
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
        $villa = Villa::findOrFail($id);
        
        if (!$villa->delete()) {
            abort(500, 'Delete failed');
        } else {
            return response()->json(['data' => 'Villa Delete!', 'status' => 1]);
        }

        return response()->json(['data' => 'Failed', 'status' => 0]);
    }

    /**
     * Create special offers of any villa
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createSpecialOffers ()
    {
        return view('admin.special-offers.create');
    }

    /**
     * Show list of special offers
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SpecialOffers ()
    {
        return view('admin.special-offers.index');
    }

    /**
     * Show list of special offers
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSpecialOffers ($id)
    {
        return view('admin.special-offers.edit', ['id' => $id]);
    }

    /**
     * Store a newly created special offers in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postSpecialOffers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'VillaOffers' => 'required',
            'Title' => 'required',
            'StartDate' => 'required',
            'EndDate' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {


            $SpecialOffers = new SpecialOffers;

            $SpecialOffers->villa_id = $request->VillaOffers['selected']['id'];
            $SpecialOffers->title = $request->Title;
            $SpecialOffers->period_start = $request->StartDate;
            $SpecialOffers->period_end = $request->EndDate;
            $SpecialOffers->discount = $request->Discount;
            $SpecialOffers->other = $request->Other;
            $SpecialOffers->created_by = auth()->user()->id;

            if (!$SpecialOffers->save()) {
                abort(500);
                return response()->json(['data' => 'Failed', 'status' => 0]);
            } else {

                return response()->json(['data' => 'Special Offers Added!', 'status' => 1]);

            }
        }
    }

    /**
     * Store a newly created special offers in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSpecialOffers(Request $request, $id)
    {

        $specialOffers = SpecialOffers::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'VillaOffers' => 'required',
            'Title' => 'required',
            'StartDate' => 'required',
            'EndDate' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['data' => $messages, 'status' => 0]);
        } else {

            $specialOffers->title = $request->Title;
            $specialOffers->period_start = $request->StartDate;
            $specialOffers->period_end = $request->EndDate;
            $specialOffers->discount = $request->Discount;
            $specialOffers->other = $request->Other;
            $specialOffers->created_by = auth()->user()->id;

            if (!$specialOffers->update()) {
                abort(500);
                return response()->json(['data' => 'Failed', 'status' => 0]);
            } else {

                return response()->json(['data' => 'Special Offers Updated!', 'status' => 1]);

            }
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSpecialOffers($id)
    {
        //
        $specialOffers = SpecialOffers::findOrFail($id);
        
        if (!$specialOffers->delete()) {
            abort(500, 'Delete failed');
        } else {
            return response()->json(['data' => 'Special Offers Delete!', 'status' => 1]);
        }

        return response()->json(['data' => 'Failed', 'status' => 0]);
    }


    /**
     * Admin API > Check if villa's name already exist
     *
     * @return \Illuminate\Http\Response JSON
     */
    public function ifVillaExist ($value)
    {
        
        $getVilla = Villa::where('title', '=', $value)->get();

        if ($getVilla->isEmpty()) {
            return response()->json(['error' => false, 'exist' => false]);
        }

        return response()->json(['error' => true, 'exist' => true]);
    }

    /**
     * Admin API > Get a record from Villa
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetVilla($id)
    {
        $villaArr = array();

        $villa = Villa::with('area')
                        ->with('environment')
                        ->find($id);
        
        $bedrooms = Villa::find($id)
                        ->bedrooms()
                        ->get(['id', 'title'])
                        ->toArray();
        if ($villa) {
            $villaArr = array(
                    'Id' => $villa->id,
                    'Status' => $villa->status,
                    'Featured' => $villa->featured,
                    'Title' => $villa->title,
                    'Area' => $villa->area->id,
                    'Area_title' => $villa->area->title,
                    'Intro' => $villa->intro,
                    'Description' => $villa->description,
                    'multipleBedroom' => $bedrooms,
                    'Services' => $villa->services,
                    'Facilities' => $villa->facilities,
                    'Staff_detail' => $villa->staff_detail,
                    'Term_condition' => $villa->term_condition,
                    'Latitude' => $villa->latitude,
                    'Longitude' => $villa->longitude,
                    'Occupied_max' => $villa->occupied_max,
                    'Bedrooms_no' => $villa->bedrooms_no,
                    'Staff_no' => $villa->staff_no,
                    'Environment' => $villa->environment->id,
                    'Environment_title' => $villa->environment->title
                );
        }

        return response()->json($villaArr);
    }

    /**
     * Admin API > Get a record from Villa
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetVillaBedrooms($id)
    {
        $bedrooms = Villa::find($id)
                        ->bedrooms()
                        ->get(['id', 'title']);

        return response()->json($bedrooms);
    }

    /**
     * Admin API > Get villa list
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetVillaList()
    {
        $villas = Villa::with(['area' => function($query) {
                            $query->select('id', 'title');
                        }])->get(['id', 'title', 'status', 'featured', 'area_id']);

        return response()->json($villas);
    }

    /**
     * Admin API > Get villa list
     *
     * @return \Illuminate\Http\Response
     */

    public function apiGetSpecialOffers()
    {
        $villas = SpecialOffers::with(['villa' => function($query) {
                            $query->select('id', 'title');
                        }])->get(['id', 'title', 'period_end', 'villa_id']);

        return response()->json($villas);
    }

    /**
     * Admin API > Get a record from Special Offers
     *
     * @return \Illuminate\Http\Response
     */

    public function apiEditSpecialOffers($id)
    {
        $offersArr = array();

        $specialOffers = SpecialOffers::where('id', $id)
                            ->with(['villa' => function($query) {
                            $query->select('id', 'title');
                        }])->get();

        if ($specialOffers) {

            foreach ($specialOffers as $key => $value) {
               $offersArr = array(
                    'Id' => $value->id,
                    'Title' => $value->title,
                    'StartDate' => $value->period_start,
                    'EndDate' => $value->period_end,
                    'Discount' => $value->discount,
                    'Other' => $value->other,
                    'VillaOffers' => array('selected' => array('title' => $value->villa->title)),
                    
                );
            }
            
        }

        return response()->json($offersArr);
    }

}

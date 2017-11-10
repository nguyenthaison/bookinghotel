<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Villa;

class SearchController extends Controller
{
    //
    function Index(Request $request){
        $villa_name = $request->input('villa-name');
        $bedroom_id = $request->input('bedroom-id');
        $area_id = $request->input('area-id');
        $sort_type = $request->has('sort-type') ? $request->input('sort-type') : "NO";
        $villa = new Villa();
        $villas = $villa->get_home_search($villa_name, $area_id, $bedroom_id);
        if ($sort_type != "NO")
            $villas = $villa->order($villas, $sort_type);
       // var_dump($villas); exit;
        return view('search')->with('villas', $villas)->with('bedroom_id', $bedroom_id)->with('area_id', $area_id)->with('vname', $villa_name)
            ->with('sort_type', $sort_type);
    }
}

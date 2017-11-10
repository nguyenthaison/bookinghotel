<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Gallery;
use Testimonial;
use Area;
use Bedroom;

class Villa extends Model
{
    //
    use SoftDeletes;

    protected $table = 'villas';
    protected $fillable = [
    						'title', 
    						'slug',
    						'area_id',
    						'intro',
    						'description',
    						'services',
    						'facilities',
    						'staff_detail',
    						'term_condition',
    						'other',
    						'longitude',
    						'latitude',
    						'occupied_max',
    						'bedrooms_no',
    						'environment_id',
    						'staff_no',
    						'position',
    						'created_by',
    					  ];

    protected $dates = ['deleted_at'];

    /**
    * Get the area for the content post.
    */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    /**
    * Get the environment for the content post.
    */
    public function environment()
    {
        return $this->belongsTo('App\Environment');
    }

    public function bedrooms()
    {
        return $this->belongsToMany('App\Bedroom');
    }

    public function rate()
    {
        return $this->hasMany('App\Rate');
    }

    public function special_offers()
    {
        return $this->hasMany('App\SpecialOffers');
    }

    public function review()
    {
        return $this->hasMany('App\Review');
    }

    public function testimonial()
    {
        return $this->hasMany('App\Testimonial');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }

    public function min_rate()
    {
        $arr = $this->rate()->orderby('rate')->select('rate')->first();
        return $arr['rate'];
    }

    public function get_by_id($id)
    {
        return $this->where('id', $id)->get();
    }

    public function get_home_search($villa_name, $area_id, $bedroom_id)
    {
        $result = Villa::where('status', 1);
        if ($bedroom_id != 0)
            $result = $result->join('bedroom_villa', 'villas.id', '=', 'bedroom_villa.villa_id')->where('bedroom_id', '=', $bedroom_id);
        if ($area_id != 0)
            $result = $result->where('area_id', '=', $area_id);
        
        $result = $result->where('title', 'like', '%'.$villa_name.'%')->with(['area' => function($query) {
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
                /*->with(['rate' => function($query) {
                    $query->select(DB::raw('MIN(rate) as min_rate, villa_id'));
                }])*/
                //->join('rates', 'villas.id', '=', 'rates.villa_id')->groupby('id')->orderby('rate')
                ->get(['id', 'area_id', 'title', 'slug', 'intro', 'bedrooms_no', 'environment_id', 'occupied_max']);
                
        //if ($bedroom_id == 0 &&)
        /*foreach ($result as $villa)
        {
            $arr = $villa->rate;
            echo $arr;
            echo '<br/>';
            echo '<br/>';
        }*/
        //var_dump($result); exit;
        //exit;
       
       return $result;
        //$this->bedrooms()->where('')
        
    }

    function order($arr, $direction)
    {
        $n = count($arr);
        $arra = $arr;
        for ($i=0; $i<$n-1; $i++)
            for ($j=$i+1; $j<$n; $j++)
            {
                if (($direction == "DESC" && $arr[$i]->min_rate() < $arr[$j]->min_rate())||($direction == "ASC" && $arr[$i]->min_rate() > $arr[$j]->min_rate()))
                {
                    $temp = $arra[$i];
                    $arra[$i] = $arra[$j];
                    $arra[$j] = $temp;
                }
            }
        return $arra;
    }
}

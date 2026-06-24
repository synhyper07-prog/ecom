<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $fillable = ['name','slug','photo','is_featured','image', 'mobile_photo', 'filter_attributes'];
    public $timestamps = false;

    public function subs(){
    	return $this->hasMany('App\Models\Subcategory')->where('status','=',1);
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function attributes() {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }

    public static function getFilterAttributes($slug) {
        $final_array = array();
        $filter_attributes_detail = Category::where('slug','=',$slug)->first(['filter_attributes']);
        if(!empty($filter_attributes_detail->filter_attributes)){
            $filter_attributes_array  = json_decode($filter_attributes_detail->filter_attributes, true);
            foreach ($filter_attributes_array as $key => $value) {
                array_push($final_array, $value['filter_attribute']);
            }
        }    
        return $final_array;
    }

}

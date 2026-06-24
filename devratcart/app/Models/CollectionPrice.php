<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CollectionPrice extends Model{
	public $timestamps = false;
    protected $fillable = ['id', 'selling_price', 'prepaid', 'postpaid', 'updated_at', 'created_at'];
}

?>
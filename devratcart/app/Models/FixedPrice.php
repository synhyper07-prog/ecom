<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FixedPrice extends Model{
	public $timestamps = false;
    protected $fillable = ['id', 'order_item_value', 'rate', 'updated_at', 'created_at'];
}

?>
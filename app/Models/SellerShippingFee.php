<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SellerShippingFee extends Model{
	public $timestamps = false;
    protected $fillable = ['id', 'weight_slab', 'zone_a', 'zone_b', 'zone_c', 'zone_d', 'zone_e', 'is_active', 'updated_at', 'created_at'];
}

?>
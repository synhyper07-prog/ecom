<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SellerShippingFee extends Model{
	public $timestamps = false;
    protected $fillable = ['id', 'weight_slab', 'local', 'zonal', 'national', 'is_active', 'updated_at', 'created_at'];
}

?>
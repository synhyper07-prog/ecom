<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Suborder extends Model{
	public $timestamps = false;
	protected $fillable = ['invoice_no', 'user_id', 'item_id', 'vendor_id','price', 'qty', 'size', 'amount', 'color', 'cart_keys', 'cart_values', 'reason', 'expected_delivery_date', 'status', 'order_id', 'is_active', 'created_at', 'shipping_name', 'shipping_country', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip', 'payment_status', 'waybill'];

    public function vendororders(){
        return $this->hasMany('App\Models\VendorOrder');
    }

    public function tracks(){
        return $this->hasMany('App\Models\OrderTrack','order_id');
    }
}


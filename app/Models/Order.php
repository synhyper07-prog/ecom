<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
	protected $fillable = ['user_id', 'cart', 'cart_itmes', 'method','shipping', 'pickup_location', 'totalQty', 'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status', 'customer_email', 'customer_name', 'customer_phone', 'customer_address', 'customer_city', 'customer_zip','shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip', 'order_note', 'status', 'order_cancellation_detail', 'cancellation_question', 'coupon_code', 'coupon_discount', 'shipping_cost', 'packing_cost', 'waybill', 'parent_order_id', 'vendor_id', 'shipping_state', 'state', 'expected_delivery_date'];
    public function vendororders(){
        return $this->hasMany('App\Models\VendorOrder');
    }

    public function tracks(){
        return $this->hasMany('App\Models\OrderTrack','order_id');
    }
}


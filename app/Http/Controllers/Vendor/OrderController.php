<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\Suborder;
use App\Models\VendorOrder;
use App\Models\Productcart;
use App\Models\Product;
use App\Models\OrderTrack;
use App\Http\Controllers\Vendor\ServicesController;
use DB;

class OrderController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $orders = VendorOrder::where('user_id','=',$user->id)->orderBy('id','desc')->get()->groupBy('order_number');
        return view('vendor.order.index',compact('user','orders'));
    }

    // public function index(){
    //     $user   = Auth::user();
    //     $orders = SubOrder::where('vendor_id','=',$user->id)->orderBy('id','desc')->get()->groupBy('invoice_no');
    //     $final_array = array();
    //     foreach ($orders as $key => $value) {
    //     	$mainorder = Order::where('id','=',$value->order_id)->first();
    //     	$invoice_detail = SubOrder::where('vendor_id','=',$user->id)->where('invoice_no','=',$value->invoice_no)->sum('amount');

        	
    //     	$detail = array('total_qty'=>SubOrder::where('vendor_id','=',$user->id)->where('invoice_no','=',$value->invoice_no)->count('id'), 'total_cost'=>);
    //     }
    //     return view('vendor.order.index',compact('user','orders'));
    // }

    public function show($slug){
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        if(!empty($order->cart_itmes)){
           $cart    = Productcart::join('products', 'products.id', '=', 'productcarts.product_id')->where('productcarts.order_id', $order->id)->get(['products.*', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.price as cart_price', 'productcarts.size as cart_size', 'productcarts.amount as cart_amount', 'productcarts.color as cart_color', 'productcarts.cart_keys', 'productcarts.cart_values', 'productcarts.reason', 'productcarts.status', 'productcarts.order_id', 'productcarts.invoice_no' , 'productcarts.qty as cart_qty']); 
           return view('vendor.order.app-order-details',compact('order','cart'));
        }
        else{
            $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
            return view('vendor.order.details',compact('user','order','cart'));
        }
        
    }

    public function license(Request $request, $slug){
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();         
        $msg = 'Successfully Changed The License Key.';
        return response()->json($msg);
    }

    public function invoice($slug){
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.invoice',compact('user','order','cart'));
    }

    public function printpage($slug){
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.print',compact('user','order','cart'));
    }

    public function status($slug,$status){
        $user  = Auth::user();
        $mainorder = VendorOrder::where('order_number','=',$slug)->first();
        $order_detail  = Order::where('order_number','=',$slug)->first();
        $user_detail   = DB::table('users')->where('id','=',$order_detail->user_id)->first();
        if(empty($user_detail->name)){
           $name = 'Customer';     
        }
        else{
           $name = $user_detail->name; 
        }
        $newDateFormat = \Carbon\Carbon::parse($order_detail->created_at)->format('d-m-Y');
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Order is Already Completed');
        }
        else{
            if($status=='on delivery'){
                $cart = Productcart::join('products', 'products.id', '=', 'productcarts.product_id')->where('productcarts.is_active','=', '0')->where('productcarts.order_id','=', $order_detail->id)->get(['products.name as product_name', 'products.sku as product_sku', 'productcarts.qty as product_quantity', 'productcarts.qty as product_quantity', 'productcarts.price as product_price', 'products.product_hsn_code as product_hsn_code', 'products.tax as product_tax_rate', 'productcarts.discount as product_discount'])->toArray();
                $cart_json = json_encode($cart, true);

                $cart_item = DB::table('productcarts')->where('order_id', $order_detail->id)->get('product_id');
                $item_array = array();
                foreach ($cart_item as $key => $item_value) {
                    $check_free_delivery = Product::where('id', $item_value->product_id)->first('free_delivery');
                    if($check_free_delivery->free_delivery == 0){
                        array_push($item_array, $item_value->product_id);
                    }
                }
                $length = Product::whereIn('id', $item_array)->sum('length');
                $width  = Product::whereIn('id', $item_array)->sum('width');
                $weight = Product::whereIn('id', $item_array)->sum('weight');
                $height    = Product::whereIn('id', $item_array)->sum('height');
                $curl = curl_init();
                curl_setopt_array($curl, array(
                        CURLOPT_URL             => "https://pre-alpha.ithinklogistics.com/api_v3/order/add.json",
                        CURLOPT_RETURNTRANSFER  => true,
                        CURLOPT_ENCODING        => "",
                        CURLOPT_MAXREDIRS       => 10,
                        CURLOPT_TIMEOUT         => 30,
                        CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST   => "POST",
                        CURLOPT_POSTFIELDS      => '{"data":{"shipments" : [{"waybill" : "","order" : "'.$order_detail->order_number.'", "sub_order" : "", "order_date" : "'.$newDateFormat.'", "total_amount" : "'.$order_detail->pay_amount.'", "name" : "'.$order_detail->customer_name.'", "company_name" : "Ecomerce",  "add" : "'.$order_detail->shipping_address.'", "add2" : "", "add3" : "", "pin" : "'.$order_detail->shipping_zip.'", "city" : "'.$order_detail->city_name.'", "state" : "'.$order_detail->state_name.'", "country" : "'.$user->country.'", "phone" : "'.$order_detail->customer_phone.'", "alt_phone" : "",  "email" : "'.$user_detail->email.'", "is_billing_same_as_shipping" : "no", "billing_name" : "'.$order_detail->customer_name.'",  "billing_company_name" : "",  "billing_add" : "'.$order_detail->shipping_address.'", "billing_add2" : "", "billing_add3" : "", "billing_pin" : "'.$order_detail->shipping_zip.'", "billing_city" : "'.$order_detail->shipping_city.'", "billing_state" : "'.$order_detail->shipping_state.'", "billing_country" : "'.$order_detail->customer_country.'", "billing_phone" : "'.$order_detail->customer_phone.'",  "billing_alt_phone" : "",  "billing_email" : "'.$user_detail->email.'", "products" :'.$cart_json.',"shipment_length":"'.$length.'","shipment_width":"'.$width.'","shipment_height":"'.$height.'","weight":"'.$weight.'","shipping_charges":"'.$order_detail->shipping_cost.'", "giftwrap_charges":"'.$order_detail->packing_cost.'", "transaction_charges":"0","total_discount":"0","first_attemp_discount":"0","cod_amount":"0","cod_charges":"0","advance_amount":"0","payment_mode":"COD","reseller_name":"","eway_bill_number":"","gst_number":"","return_address_id":"1344"}],"pickup_address_id":"1344","access_token":"50d95e0f7438515d7d40da216fe1b8f4","secret_key":"cf7cafded40dc92f3ad19dda487626af","logistics":"Delhivery","s_type":"ground","order_type":""}}',
                        CURLOPT_HTTPHEADER => array("cache-control: no-cache", "content-type: application/json"),));
                $response = curl_exec($curl);
                $err      = curl_error($curl);
                curl_close($curl);
                $data  = json_decode($response);
                foreach($data->data as $val){
                    $waybill =   $val->waybill;
                }
                Order::where('order_number','=',$slug)->update(['waybill'=>$waybill]);
                $expected_delivery_date = ServicesController::trackorder($waybill);
                $message = "Dear ".$name." your order no ".$slug." has been out for delivery and expected delivery date is ".$expected_delivery_date;
                ServicesController::sendMessage($message,  $user_detail->phone);
            }
            else{
                if($status !='pending'){
                    $message = "Dear ".$name." your order no ".$slug." has been ".$status;
                    ServicesController::sendMessage($message,  $user_detail->phone);
                }
            }
            $order_track = array();
            $order_track['title']      = $status;
            $order_track['text']       = 'Order has been '.$status.' successfully';
            $order_track['order_id']   = $order_detail->id;
            $order_track  = OrderTrack::create($order_track);    
            Order::where('order_number','=',$slug)->where('vendor_id','=',$user->id)->update(['status' => $status]);
            $order = VendorOrder::where('order_number','=',$slug)->where('user_id','=',$user->id)->update(['status' => $status]);
	        return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully');
	    }
    }
}

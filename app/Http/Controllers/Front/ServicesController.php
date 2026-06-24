<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\Suborder;
use App\Models\VendorOrder;
use App\Models\Productcart;
use App\Models\Product;
use DB;
use Session;

class ServicesController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    static function trackorder($waybill){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => "https://pre-alpha.ithinklogistics.com/api_v3/order/track.json",
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_POSTFIELDS      => '{"data":{"awb_number_list":"'.$waybill.'","access_token":"50d95e0f7438515d7d40da216fe1b8f4","secret_key":"cf7cafded40dc92f3ad19dda487626af"}}',
            CURLOPT_HTTPHEADER      => array(
              "cache-control: no-cache",
              "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        }
        else{
            $data = json_decode($response);
            foreach ($data as $key => $value) {
                foreach ($value as $key => $val) {
                    Order::where('waybill','=',$waybill)->update(['expected_delivery_date'=>$val->order_date_time->expected_delivery_date]);
                    return $val->order_date_time->expected_delivery_date;
                }
            }
        }
    }


    static function sendMessage($message, $phone_no){
        $url = "http://login.yourbulksms.com/api/sendhttp.php?authkey=17856AlUIma1509Q5fe053dcP15&mobiles=".$phone_no."&message=".urlencode($message)."&sender=RATCRT&route=4&country=91";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_HTTPHEADER     => array(
                "authkey: 17856AlUIma1509Q5fe053dcP15",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl); 
    }

    static function bifercate_cart_vendor_wise($cart){
        DB::table('productcarts')->where('order_id', '0')->where('user_id', Auth::guard('web')->user()->id)->delete();
        foreach ($cart->items as $key => $value) {
            if(!empty($value)){
                $data['user_id']     =  Auth::guard('web')->user()->id;
                $data['vendor_id']   =  $value['item']->user_id;
                $data['product_id']  =  $value['item']->id;
                $data['price']       =  $value['item_price'];
                $data['qty']         =  $value['qty'];
                $data['size']        =  $value['size'];
                $data['amount']      =  $value['price'];
                $data['items']       =  $value['item'];
                $data['color']       =  $value['color'];
                $data['cart_keys']   =  $value['keys'];
                $data['cart_values'] =  $value['values'];
                DB::table('productcarts')->insert($data);
            }    
        }
        $vendor_wise_cart    = array();
        $vendors = DB::table('productcarts')->where('user_id', Auth::guard('web')->user()->id)->groupBy('vendor_id')->where('order_id', '0')->get('vendor_id');
        foreach ($vendors as $key => $vendor) {
            $cart_detail    = DB::table('productcarts')->where('user_id', Auth::guard('web')->user()->id)->where('vendor_id', $vendor->vendor_id)->where('order_id', '0')->get(['vendor_id', 'product_id', 'shipping_cost']);
            $vendor->cart = $cart_detail;
            $vendor->tot_shipping_cost = DB::table('productcarts')->where('user_id', Auth::guard('web')->user()->id)->where('vendor_id', $vendor->vendor_id)->where('order_id', '0')->sum('shipping_cost');   
            array_push($vendor_wise_cart, $vendor);
        }
        return $vendor_wise_cart; 
    }

    static function calculateShippingCharge($pincode_from, $pincode_to, $height, $width, $length, $weight, $mrp){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL             => "https://pre-alpha.ithinklogistics.com/api_v3/rate/check.json",
          CURLOPT_RETURNTRANSFER  => true,
          CURLOPT_ENCODING        => "",
          CURLOPT_MAXREDIRS       => 10,
          CURLOPT_TIMEOUT         => 30,
          CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST   => "POST",
          CURLOPT_POSTFIELDS      => '{"data":{"from_pincode":"'.$pincode_from.'", "to_pincode" : "'.$pincode_to.'","shipping_length_cms":"'.$length.'","shipping_width_cms":"'.$width.'","shipping_height_cms":"'.$height.'","shipping_weight_kg":"'.$weight.'","order_type":"forward","payment_method":"cod","product_mrp":"'.$mrp.'","access_token":"50d95e0f7438515d7d40da216fe1b8f4","secret_key":"cf7cafded40dc92f3ad19dda487626af"}}',
          CURLOPT_HTTPHEADER      => array(
              "cache-control: no-cache",
              "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        else{
            $data = json_decode($response);
            foreach ($data->data as $key => $value) {
                if($value->logistic_name=='Delhivery'){
                    return $value->rate;
                    break;
                }
            } 
        }
    }
}

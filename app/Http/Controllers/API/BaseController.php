<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use App\Models\Order;
use App\Models\Productcart; 
use App\Models\VendorOrder;
use App\Models\OrderTrack;  
use PDF;
use DB;


class BaseController extends Controller{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendResponse($result, $message){
        $response = array();
        $response['success']  = true;
        if(!empty($result)){
            $response['data'] = $result;
        }
        $response['message']  = $message;
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendError($error, $errorMessages = [], $code = 404){
        if($error =='Validation Error.'){
            $code  = 200;
        }
        else{
            $code  = 400;
        }
        $response = ['success' => false, 'message' => $error,];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


    public function sendPushNotification($message, $firebase_token){
        define('API_ACCESS_KEY', 'AAAAMfkBU4w:APA91bEmQVV1wAMp0JEbtd9TvfgUAafKToZJgczezJXek08UHAmGOQv1xbFb5fUgf9OiV-brXLn0z9wZORoFB2PkSC47kqhRP2sCjjDcOvj4YiGqDG9-zsycwCHt9JKtax--mV6REjaL');
        $registrationIds = $firebase_token;
        $body            = $message;
        $title           = config('app.name');
        #prep the bundle
        $msg             = array(
            'body'       => $body,
            'title'      => $title,
            'icon'       => 'myicon',
            'type'       => '',
            'id'         => '0',
            /*Default Icon*/
            'sound'      => 'mySound'
            /*Default sound*/
        );
        $fields             = array(
            'to'            => $registrationIds,
            'notification'  => $msg
        );
        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server    
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);


        if (curl_errno($ch)) {
            $info = curl_getinfo($ch);
            print_r($info);
        }
        curl_close($ch);
        #Echo Result Of FireBase Server
       return 'success';
    }


    public function sendSms($mobile, $sms) {
        $url = "http://login.yourbulksms.com/api/sendhttp.php?authkey=17856AlUIma1509Q5fe053dcP15&mobiles=".$mobile."&message=".urlencode($sms)."&sender=RATCRT&route=4&country=91";
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

    public function generateOrderPdf($order_id) {
        $order = Order::findOrfail($order_id);
        $cart    = Productcart::join('products', 'products.id', '=', 'productcarts.product_id')->where('productcarts.order_id', $order_id)->get(['products.*', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.id as cart_id', 'productcarts.price as cart_price', 'productcarts.size as cart_size', 'productcarts.amount as cart_amount', 'productcarts.color as cart_color', 'productcarts.cart_keys', 'productcarts.cart_values', 'productcarts.reason', 'productcarts.status', 'productcarts.order_id', 'productcarts.invoice_no' , 'productcarts.qty as cart_qty']);
        $pdf   = PDF::loadView('user.order.order-item-invoice',compact('order','cart'));
        $path = public_path('invoice_pdf/');
        $fileName =  'order'.$order->order_number . '.' . 'pdf' ;
        $pdf->save($path . $fileName);
        return $fileName;
    }    


    public function sendmail($pdf, $order_no) {
        $name        = config('app.name');
        $email       = "ratcartinfo@gmail.com";
        $to          = Auth::user()->email;
        $from        = "ratcartinfo@gmail.com";
        $subject     = "Invoice of new order from ".config('app.name');
        $mainMessage = "Dear ".Auth::user()->name.", thank you for placing new order on ".config('app.name').". below is attached invoice of order no ".$order_no;
        $fileatt     = public_path('invoice_pdf/'.$pdf);
        $fileatttype = "application/pdf";
        $fileattname = "Order_invoice".$order_no.".pdf";
        $headers = "From: $from";
        $file = fopen($fileatt, 'rb');
        $data = fread($file, filesize($fileatt));
        fclose($file);
        $semi_rand     = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers      .= "\nMIME-Version: 1.0\n" .
        "Content-Type: multipart/mixed;\n" .
        " boundary=\"{$mime_boundary}\"";
        $message = "This is a multi-part message in MIME format.\n\n" .
        "-{$mime_boundary}\n" .
        "Content-Type: text/plain; charset=\"iso-8859-1\n" .
        "Content-Transfer-Encoding: 7bit\n\n" .
        $mainMessage  . "\n\n";

        $data = chunk_split(base64_encode($data));
        $message .= "--{$mime_boundary}\n" .
        "Content-Type: {$fileatttype};\n" .
        " name=\"{$fileattname}\"\n" .
        "Content-Disposition: attachment;\n" .
        " filename=\"{$fileattname}\"\n" .
        "Content-Transfer-Encoding: base64\n\n" .
        $data . "\n\n" .
        "-{$mime_boundary}-\n";
        mail($to, $subject, $message, $headers);  
    }

    public function get_vendor_ship_charge($pincode_from, $pincode_to, $height, $width, $length, $weight, $mrp) {
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

    public function bifercate_cart_vendor_wise() {
        $vendor_wise_cart    = array();
        $vendors = DB::table('productcarts')->where('user_id', Auth::user()->id)->groupBy('vendor_id')->where('order_id', '0')->get('vendor_id');
        foreach ($vendors as $key => $vendor) {
            $cart_detail    = DB::table('productcarts')->where('user_id', Auth::user()->id)->where('vendor_id', $vendor->vendor_id)->where('order_id', '0')->get(['vendor_id', 'product_id', 'shipping_cost']);
            $vendor->cart = $cart_detail;
            $vendor->tot_shipping_cost = DB::table('productcarts')->where('user_id', Auth::user()->id)->where('vendor_id', $vendor->vendor_id)->where('order_id', '0')->sum('shipping_cost');   
            array_push($vendor_wise_cart, $vendor);
        }
        return $vendor_wise_cart;
    }

    public function create_suborder($request, $delivery_charge, $vendor_id, $parent_order_id, $payment_method, $payment_status) {
        $tot_qty     = DB::table('productcarts')->where('vendor_id', $vendor_id)->sum('qty');
        $tot_amount  = DB::table('productcarts')->where('vendor_id', $vendor_id)->sum('amount');
        $shipping_cost  = DB::table('productcarts')->where('vendor_id', $vendor_id)->sum('shipping_cost');
        $cart        = DB::table('productcarts')->where('user_id', Auth::user()->id)->where('vendor_id', $vendor_id)->where('order_id', '0')->get();
        $item_number = Auth::user()->id.(Str::random(15)); 
        $order_info  = array();
        $order_info['user_id']            = Auth::user()->id;
        $order_info['cart']               = $cart;
        $order_info['cart_itmes']         = $cart; 
        $order_info['totalQty']           = $tot_qty;
        $order_info['pay_amount']         = $tot_amount + $shipping_cost;
        $order_info['method']             = $payment_method;
        $order_info['shipping']           = $request->shipping;
        $order_info['pickup_location']    = $request->pickup_location;
        $order_info['customer_email']     = $request->email;
        $order_info['customer_name']      = $request->name;
        $order_info['packing_cost']       = $request->packing_cost;
        $order_info['tax']                = '0';
        $order_info['customer_phone']     = $request->phone;
        $order_info['order_number']       = $item_number;
        $order_info['customer_address']   = $request->address;
        $order_info['customer_country']   = $request->customer_country;
        $order_info['customer_city']      = $request->city;
        $order_info['customer_zip']       = $request->zip;
        $order_info['state']              = 'Uttar Pradesh';
        $order_info['shipping_state']     = 'Uttar Pradesh';
        $order_info['shipping_country']   = 'India';
        $order_info['shipping_email']     = $request->shipping_email;
        $order_info['shipping_name']      = $request->shipping_name;
        $order_info['shipping_phone']     = $request->shipping_phone;
        $order_info['shipping_address']   = $request->shipping_address;
        $order_info['shipping_country']   = $request->shipping_country;
        $order_info['shipping_city']      = $request->shipping_city;
        $order_info['shipping_zip']       = $request->shipping_zip;
        $order_info['shipping_cost']      = $delivery_charge;
        $order_info['order_note']         = $request->order_notes;
        $order_info['coupon_code']        = $request->coupon_code;
        $order_info['coupon_discount']    = $request->coupon_discount;
        $order_info['payment_status']     = $payment_status;
        $order_info['parent_order_id']    = $parent_order_id;
        $order_info['vendor_id']          = $vendor_id;
        try {
            $order_detail = Order::create($order_info);  
        }
        catch(\Exception $e) {
            return $this->sendError($e, '');
        }
        DB::table('productcarts')->where('is_active', '1')->where('order_id', '0')->where('vendor_id', $vendor_id)->where('user_id', Auth::user()->id)->update(['order_id' =>$order_detail->id, 'is_active'=>'0', 'parent_order_id' =>$parent_order_id]);
        $vendor_order_mapping = array();
        $vendor_order_mapping['user_id']      = $vendor_id;
        $vendor_order_mapping['order_id']     = $order_detail->id;
        $vendor_order_mapping['qty']          = $order_detail->totalQty;
        $vendor_order_mapping['price']        = $order_detail->pay_amount;
        $vendor_order_mapping['order_number'] = $order_detail->order_number;
        $vendor_order_mapping = VendorOrder::create($vendor_order_mapping);

        $order_track = array();
        $order_track['title']     = 'Pending';
        $order_track['text']      = 'You have successfully placed your order.';
        $order_track['order_id']  = $order_detail->id;
        $order_track = OrderTrack::create($order_track);
        return true;
    }    
}
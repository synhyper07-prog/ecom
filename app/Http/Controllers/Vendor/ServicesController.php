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
use DB;

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


    // public function sendPushNotification($message, $firebase_token){
    //     define('API_ACCESS_KEY', 'AAAAMfkBU4w:APA91bEmQVV1wAMp0JEbtd9TvfgUAafKToZJgczezJXek08UHAmGOQv1xbFb5fUgf9OiV-brXLn0z9wZORoFB2PkSC47kqhRP2sCjjDcOvj4YiGqDG9-zsycwCHt9JKtax--mV6REjaL');
    //     $registrationIds = $firebase_token;
    //     $body            = $message;
    //     $title           = config('app.name');
    //     #prep the bundle
    //     $msg             = array(
    //         'body'       => $body,
    //         'title'      => $title,
    //         'icon'       => 'myicon',
    //         'type'       => '',
    //         'id'         => '0',
    //         /*Default Icon*/
    //         'sound'      => 'mySound'
    //         /*Default sound*/
    //     );
    //     $fields             = array(
    //         'to'            => $registrationIds,
    //         'notification'  => $msg,
    //         'data'          => $msg
    //     );
    //     $headers = array(
    //         'Authorization: key=' . API_ACCESS_KEY,
    //         'Content-Type: application/json'
    //     );
    //     #Send Reponse To FireBase Server    
    //     $ch      = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    //     $result = curl_exec($ch);


    //     if (curl_errno($ch)) {
    //         $info = curl_getinfo($ch);
    //         print_r($info);
    //     }
    //     curl_close($ch);
    //     #Echo Result Of FireBase Server
    //    return 'success';
    // }
}

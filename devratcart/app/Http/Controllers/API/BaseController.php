<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


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
        $title           = 'Ratcart';
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
}
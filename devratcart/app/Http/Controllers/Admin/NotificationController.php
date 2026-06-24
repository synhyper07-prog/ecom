<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use DB;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_notf_count()
    {

        $user_count = DB::table('notifications')->where('user_id','!=',null)->where('is_read','=',0)->count();
        $order_count = DB::table('notifications')->where('order_id','!=',null)->where('is_read','=',0)->count();
        $product_count = DB::table('notifications')->where('product_id','!=',null)->where('is_read','=',0)->count();
        $conv_count = DB::table('notifications')->where('conversation_id','!=',null)->where('is_read','=',0)->count();

        $data = array();        
        $data['user_count'] = $user_count;
        $data['conv_count'] = $conv_count;
        $data['order_count'] = $order_count;
        $data['product_count'] = $product_count;

        return response()->json($data);            
    } 


    public function user_notf_clear()
    {
        $data = Notification::where('user_id','!=',null);
        $data->delete();        
    } 

    public function user_notf_show()
    {
        $datas = Notification::where('user_id','!=',null)->latest('id')->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.register',compact('datas'));           
    } 


    public function order_notf_clear()
    {
        $data = Notification::where('order_id','!=',null);
        $data->delete();        
    } 

    public function order_notf_show()
    {
        $datas = Notification::where('order_id','!=',null)->latest('id')->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.order',compact('datas'));           
    } 


    public function product_notf_clear()
    {
        $data = Notification::where('product_id','!=',null);
        $data->delete();        
    } 

    public function product_notf_show()
    {
        $datas = Notification::where('product_id','!=',null)->latest('id')->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.product',compact('datas'));           
    } 


    public function conv_notf_clear(){
        $data = Notification::where('conversation_id','!=',null);
        $data->delete();        
    }


    public function pushNotificationFForm(){
         return view('admin.notification.push-notification');         
    } 

    public function send_push_notification(Request $request){
        define('API_ACCESS_KEY', 'AAAAMfkBU4w:APA91bEmQVV1wAMp0JEbtd9TvfgUAafKToZJgczezJXek08UHAmGOQv1xbFb5fUgf9OiV-brXLn0z9wZORoFB2PkSC47kqhRP2sCjjDcOvj4YiGqDG9-zsycwCHt9JKtax--mV6REjaL');

        $users_list = DB::table('users')->where('is_vendor', '0')->whereNotNull('fire_base_token')->get('fire_base_token');

        $firebase_token_arr = array();
        foreach ($users_list as $key => $value) {
        	//array_push($firebase_token_arr, $value->fire_base_token);
            $registrationIds = $value->fire_base_token;
            $body            = $request['message'];
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
        }
        return view('admin.notification.push-notification')->with('message', 'Notification sent successfully');           
    } 

}
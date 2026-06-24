<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use Auth;
use Validator;
use DB;

class RegisterController extends Controller{
    public function register(Request $request){
    	$gs = Generalsetting::findOrFail(1);
    	if($gs->is_capcha == 1){
	        $value = session('captcha_string');
	        if ($request->codes != $value){
	            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	        }    		
    	}
        //--- Validation Section
        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $user = new User;
        $input = $request->all();        
        $input['password'] = bcrypt($request['password']);
        $token = md5(time().$request->name.$request->email);
        $input['verification_link'] = $token;
        $input['affilate_code'] = md5($request->name.$request->email);

        if(!empty($request->vendor)){
			//--- Validation Section
			if ($user_signature_file      = $request->file('user_signature')) {
	            $signature_name           = time().str_replace(' ', '', $user_signature_file->getClientOriginalName());
	            $user_signature_file->move('assets/images/signature',$signature_name);
	            $input['user_signature']       = $signature_name;
	        }
	        if ($vendor_image_file        = $request->file('vendor_image')) {
	            $vendor_image_name        = time().str_replace(' ', '', $vendor_image_file->getClientOriginalName());
	            $vendor_image_file->move('assets/images/users',$vendor_image_name);
	            $input['photo'] = $vendor_image_name;
	        }
	        if ($user_adhar_card_file     = $request->file('user_adhar_card')) {
	            $user_adhar_image_name    = time().str_replace(' ', '', $user_adhar_card_file->getClientOriginalName());
	            $user_adhar_card_file->move('assets/images/adhar',$user_adhar_image_name);
	            $input['adhar']           = $user_adhar_image_name;
	        }
			$rules = [
				'shop_name' => 'unique:users',
				'shop_number'  => 'max:10'
					];
			$customs = [
				'shop_name.unique' => 'This Shop Name has already been taken.',
				'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
			];
			$validator = Validator::make($request->all(), $rules, $customs);
			if ($validator->fails()) {
			return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
			}
			$input['is_vendor'] = 1;
			$type  = 'vendor';
		}
		else{
			$type  = 'user';
		}
		if($type == 'vendor'){
			$to = $request->email;
	        $subject = 'Vendor signup on Ratcart';
	        $msg = "Your form has been submitted with us. we will verify and send confermation email to you. have patience</n>.Thanks team Ratcart";
	        $headers = "From: Ratcart<ratcartino@gmail.com>";
	        try {
	            mail($to,$subject,$msg,$headers);
	        }
	        catch (Exception $ex) {
		        dd($ex);
		    }    
		} 
		$user->fill($input)->save();
		$to        = $request->email;
        $subject   = 'Ratcart signup';
        $headers   = 'MIME-Version: 1.0' . "\n";
        $headers  .='Content-Type: text/html; charset="UTF-8"'."\n";
        $headers  .= "From: Ratcart<ratcartinfo@gmail.com>";
        $image     = "http://ratcart.com/assets/images/1608292812ratcart.png";
        $message   = '<img src="'.$image.'" style="height:300px; width:300px;">';
		$message  .= '<p>Welcome to Ratcart '.$request->name.', enjoy online shopping with us. thanks to be a part of our world</p>';
        try {
            mail($to,$subject,$message,$headers);
        }
        catch (Exception $ex) {
	        dd($ex);
	    }
        if($gs->is_verification_email == 1){
	        $to = $request->email;
	        $subject = 'Verify your email address.';
	        $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";
        //Sending Email To Customer
        if($gs->is_smtp == 1){
	        $data = [
	            'to'      => $to,
	            'subject' => $subject,
	            'body'    => $msg,
	        ];
	        $mailer = new GeniusMailer();
	        $mailer->sendCustomMail($data);
        }
        else{
	        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
	        mail($to,$subject,$msg,$headers);
        }
      	    return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
        }
        else {
            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user); 
          	return response()->json(1);
        }
    }

    public function showVendorRegisterForm(){
        $state_list = DB::table('states')->where('country_id', '101')->orderBy('name')->get();
        return view('user.vendor-register', compact('state_list'));
    }

    public function vendorRegisterPost(Request $request){
        $rules = ['email'   => 'required|email', 'password' => 'required|confirmed', 'shop_number' => 'max:10'];
        $customs = [
			'shop_name.unique' => 'This Shop Name has already been taken.',
			'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
		];
		$validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
            return redirect()->route('vendor-register')->withErrors($validator)->withInput();
        }
        $state_detail = DB::table('states')->where('id', $request->state_id)->first();
        $city_detail  = DB::table('cities')->where('id', $request->city_id)->first();
        //--- Validation Section Ends
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => "https://pre-alpha.ithinklogistics.com/api_v2/warehouse/add.json",
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_POSTFIELDS      => "{\"data\":{\"company_name\":\"".$request->shop_number."\",\"address1\":\"".$request->address."\",\"address2\":\"". $request->address2."\",\"mobile\":\"". $request->phone."\",\"pincode\":\"".$request->pincode."\",\"city_id\":\"".$request->city_id."\",\"state_id\":\"".$request->state_id."\",\"country_id\":\"101\",\"access_token\":\"50d95e0f7438515d7d40da216fe1b8f4\",\"secret_key\":\"cf7cafded40dc92f3ad19dda487626af\"}}\n",
            CURLOPT_HTTPHEADER      => array(
              "cache-control: no-cache",
              "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);

        $user = new User;
        $input = $request->all();
        $input['warehouse_id'] = '1344';
        $input['country_id']   = '101';        
        $input['country']      = 'India';
        $input['state_name']   = $state_detail->name;
        $input['zip']          = $request->pincode;
        $input['city']         = $city_detail->name;
        $input['city_name']    = $city_detail->name;
        $input['address']      = $request->address.' '.$request->address2;
        $token = md5(time().$request->name.$request->email);
        $input['verification_link']      = $token;
        $input['affilate_code']          = md5($request->name.$request->email);

        if ($user_signature_file         = $request->file('user_signature')) {
            $signature_name              = time().str_replace(' ', '', $user_signature_file->getClientOriginalName());
            $user_signature_file->move('assets/images/signature',$signature_name);
            $input['user_signature']     = $signature_name;
        }
        if ($vendor_image_file           = $request->file('user_image')) {
            $vendor_image_name           = time().str_replace(' ', '', $vendor_image_file->getClientOriginalName());
            $vendor_image_file->move('assets/images/users',$vendor_image_name);
            $input['photo']              = $vendor_image_name;
        }
        if ($user_adhar_card_file        = $request->file('user_adhar_card')) {
            $user_adhar_image_name       = time().str_replace(' ', '', $user_adhar_card_file->getClientOriginalName());
            $user_adhar_card_file->move('assets/images/adhar',$user_adhar_image_name);
            $input['adhar']              = $user_adhar_image_name;
        }
        if ($user_adhar_card_back_file   = $request->file('user_adhar_card_back')) {
            $user_adhar_back_image_name  = time().str_replace(' ', '', $user_adhar_card_back_file->getClientOriginalName());
            $user_adhar_card_back_file->move('assets/images/adhar',$user_adhar_back_image_name);
            $input['adhar_back']         = $user_adhar_back_image_name;
        }
		$input['is_vendor'] = 1;
		$input['gstin'] = $request->gstin;
        $input['password'] = bcrypt($request['password']);
		$user->fill($input)->save();
		$to = $request->email;
        $subject = 'Vendor signup on Ratcart';
        $msg = "Your form has been submitted with us. we will verify and send confermation email to you. have patience</n>.Thanks team Ratcart";
        $headers = "From: Ratcart<ratcartinfo@gmail.com>";
        try {
            mail($to,$subject,$msg,$headers);
        }
        catch (Exception $ex) {
	        dd($ex);
	    }
	    $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->save();
        Auth::guard('web')->login($user);
        return redirect('user/package')->with('message', 'Login successfully');
    }

    public function token($token){
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_verification_email == 1){    	
	        $user = User::where('verification_link','=',$token)->first();
	        if(isset($user)){
	            $user->email_verified = 'Yes';
	            $user->update();
		        $notification = new Notification;
		        $notification->user_id = $user->id;
		        $notification->save();
	            Auth::guard('web')->login($user); 
	            return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
	        }
        }
		else {
		    return redirect()->back();	
		}
    }


    public function getCityList(Request $request){
        $data['cities'] =  DB::table('cities')->where('state_id', $request->state_id)->get();
        return response()->json($data);
    }

    public function validate_pin_code(Request $request){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => "https://pre-alpha.ithinklogistics.com/api_v2/pincode/check.json",
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_POSTFIELDS      => "{\"data\":{\"pincode\":\"".$request->pin_code."\",\"access_token\":\"50d95e0f7438515d7d40da216fe1b8f4\",\"secret_key\":\"cf7cafded40dc92f3ad19dda487626af\"}}\n",
            CURLOPT_HTTPHEADER      => array(
              "cache-control: no-cache",
              "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        $response_array = json_decode($response, true);
        if($response_array['data'][$request->pin_code]['xpressbees']['pickup']  == 'Y'){
           return 1;
        }
        else{
           return 0;
        }
    }
}
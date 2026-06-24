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
			$to = 'puneetdev.090@gmail.com';
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
      return view('user.vendor-register');
    }

    public function vendorRegisterPost(Request $request){
        $rules = ['email'   => 'required|email|unique:users', 'password' => 'required|confirmed', 'shop_name' => 'unique:users', 'shop_number' => 'max:10'];
        $customs = [
			'shop_name.unique' => 'This Shop Name has already been taken.',
			'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
		];
		$validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return redirect('vendor-register')->withErrors($validator)->withInput();	
        }
        //--- Validation Section Ends
        $user = new User;
        $input = $request->all();        
        $input['password'] = bcrypt($request['password']);
        $token = md5(time().$request->name.$request->email);
        $input['verification_link'] = $token;
        $input['affilate_code'] = md5($request->name.$request->email);
        if ($user_signature_file      = $request->file('user_signature')) {
            $signature_name           = time().str_replace(' ', '', $user_signature_file->getClientOriginalName());
            $user_signature_file->move('assets/images/signature',$signature_name);
            $input['user_signature']  = $signature_name;
        }
        if ($vendor_image_file        = $request->file('vendor_image')) {
            $vendor_image_name        = time().str_replace(' ', '', $vendor_image_file->getClientOriginalName());
            $vendor_image_file->move('assets/images/users',$vendor_image_name);
            $input['photo']           = $vendor_image_name;
        }
        if ($user_adhar_card_file     = $request->file('user_adhar_card')) {
            $user_adhar_image_name    = time().str_replace(' ', '', $user_adhar_card_file->getClientOriginalName());
            $user_adhar_card_file->move('assets/images/adhar',$user_adhar_image_name);
            $input['adhar']           = $user_adhar_image_name;
        }
		$input['is_vendor'] = 1;
		$user->fill($input)->save();
		$to = 'puneetdev.090@gmail.com';
        $subject = 'Vendor signup on Ratcart';
        $msg = "Your form has been submitted with us. we will verify and send confermation email to you. have patience</n>.Thanks team Ratcart";
        $headers = "From: Ratcart<ratcartino@gmail.com>";
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
}
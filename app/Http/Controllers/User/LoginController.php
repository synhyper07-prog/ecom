<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

use Validator;

class LoginController extends Controller{
    public function __construct(){
      $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function showLoginForm(){
      $this->code_image();
      return view('user.login');
    }

    public function login(Request $request){
        $rules = ['email'   => 'required', 'password' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        if(is_numeric($request->get('email'))){
       	  $user =  Auth::attempt(['phone' => $request->email, 'password' => $request->password, 'is_vendor' => '0']);
        }
        else{
          $user =  Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_vendor' => '0']); 
        }	
        if ($user) {
	        if(Auth::guard('web')->user()->ban == 1){
	            Auth::guard('web')->logout();
	            return response()->json(array('errors' => [ 0 => 'Your Account Has Been Banned.' ]));   
	        }
            if(!empty($request->modal)){
	            if(!empty($request->vendor)){
	                if(Auth::guard('web')->user()->is_vendor == 2){
	                	Auth::guard('web')->logout();
	                    return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ])); 
	                }
	                else if(Auth::guard('web')->user()->is_vendor == 1){
	                    return response()->json(route('user-package'));
	                }
	                else {
	                    return response()->json(route('user-package'));
	                }
	            }
                return response()->json(1);          
            }
            return response()->json(route('front.index'));
        }
        return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));     
    }


    public function vendorLoginPost(Request $request){
        $rules = ['email'   => 'required', 'password' => 'required', 'is_vendor' => '2'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
           return redirect('user/vendor-login')->withErrors($validator)->withInput();
        }
        if(is_numeric($request->get('email'))){
          $user =  Auth::attempt(['phone' => $request->email, 'password' => $request->password]);
        }
        else{
          $user =  Auth::attempt(['email' => $request->email, 'password' => $request->password]); 
        }
        if($user){
            if(Auth::guard('web')->user()->is_vendor == 0){
              Auth::guard('web')->logout();
              return redirect()->intended('user/vendor-login')->withErrors([
                'error_message' => 'The provided credentials do not match our records.',
              ]);
            }
            else{
              if(Auth::guard('web')->user()->is_vendor == 2){
                return redirect('vendor/dashboard')->with('message', 'Login successfully');
              }
              else {
                return redirect('user/package')->with('message', 'Login successfully');
              } 
            }
        }
        return redirect()->intended('user/vendor-login')->withErrors([
            'error_message' => 'The provided credentials do not match our records.',
        ]);           
    }

    public function showVendorLoginForm(){
      return view('user.vendor-login');
    }

    public function logout(){
      Auth::guard('web')->logout();
      return redirect('/');
    }

    // Capcha Code Image
    private function  code_image(){
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++){
          imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'/public/assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++){
          $letter = $allowed_letters[rand(0, $length-1)];
          imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
          $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++){
          imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."/public/assets/images/capcha_code.png");
    }
    
}

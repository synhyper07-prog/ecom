<?php 

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Otp;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Suborder;
use App\Models\Category;
use App\Models\Currency;
use App\Models\ProductClick;
use App\Models\Productcart;
use Carbon\Carbon;
use App\Models\Generalsetting;
use App\Models\Gallery;
use App\Models\Wishlist;
use App\Models\VendorOrder;
use App\Models\Coupon;
use Razorpay\Api\Api;
use App\Models\Cart;
use App\Models\UserNotification;
use App\Models\OrderTrack;
use App\Models\Notification;
use App\Models\Address;
use App\Models\Rating;
use App\Models\AppSlider;
use App\Models\Log;
use DB;
use Validator;
use PDF;


class ApiController extends BaseController{ 
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $rdata = Generalsetting::findOrFail(1);
        $this->keyId = $rdata->razorpay_key;
        $this->keySecret = $rdata->razorpay_secret;
        $this->displayCurrency = 'INR';
        $this->api = new Api($this->keyId, $this->keySecret);
    }

    public function base_url(){
        $success['base_url']  = config('app.url');
        return $this->sendResponse($success, 'Success.');
    }

    public function login(Request $request){
        if(Auth::attempt(['phone' => $request['mobile_no'], 'password' =>$request['password']])){ 
            $token = hash('sha256', Str::random(60));
            $user  = Auth::user();
            // $user->api_token     =  $token;
            // $user->save();
            $success['token']    = $user->api_token; 
            $success['name']     =  $user->name;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    /**
     * Social login api
     *
     * @return \Illuminate\Http\Response
     */

    public function Sociallogin(Request $request){
        $user= DB::table('users')->where('email', $request['email'])->first();
        if(!empty($user)){
            $token = hash('sha256', Str::random(60));
            try {
                DB::table('users')->where('id', $user->id)->update(['api_token' =>$token]);
            }
            catch(\Exception $e) {
                return $this->sendError($e, '');
            } 
            $success['token']    =  $token; 
            $success['name']     =  $user->name;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    /**
     * Update firebase token api
     *
     * @return \Illuminate\Http\Response
     */

    public function updateFirebaseToken(Request $request){
        $user  = Auth::user();
        if(!empty($user)){
            DB::table('users')->where('id', $user->id)->update(['fire_base_token' =>$request['firebase_token']]);
            return $this->sendResponse('Firebase token updated successfully', '');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    /**
     * Send otp
     *
     * @return \Illuminate\Http\Response
     */

    public function sendOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_no'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $otp_str   =  rand(10000, 99999);
        $message  =   config('app.name').': Your code is '.$otp_str;
        $this->sendSms($request['mobile_no'], $message);
        $otp_input = array('mobile_no'=>$request['mobile_no'], 'otp_str'=>$otp_str);
        try {
            Otp::create($otp_input);
            $success['otp']      =  $otp_str; 
            return $this->sendResponse($success, 'Otp sent successfully.');  
        }
        catch(\Exception $e) {
            return $this->sendError($e, '');
        }   
    }



    /**
     * Verify otp
     *
     * @return \Illuminate\Http\Response
     */

    public function verifyOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required',
            'otp'       => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $get_opt_detail =  DB::table('otps')->where('mobile_no', $request['mobile_no'])->where('otp_str', $request['otp'])->orderBy('id', 'desc')->first();
        if(empty($get_opt_detail)){
            return $this->sendError('Wrong otp', '');
        }
        else{
            return $this->sendResponse('Otp verified successfully.', '');
        }
    }


    /**
     * User registration
     *
     * @return \Illuminate\Http\Response
     */

    public function userRegistration(Request $request){
        $token    = md5(time().$request['name'].$request['email']);
        $password = bcrypt($request['password']);
        $input    = array('name'=>$request['name'], 'email'=>$request['email'], 'phone'=>$request['mobile_no'], 'address'=>$request['address'],  'password'=>$password, 'remember_token'=>$token, 'api_token'=>$token, 'verification_link'=>$token, 'affilate_code'=>md5($request['name'].$request['email']), 'created_at'=>date('Y-m-d H:i:s'));
        $user     = User::create($input);
        $success['token']    =  $token; 
        $success['name']     =  $user->name;
        return $this->sendResponse($success, 'User registered successfully.');     
    }


    /**
     * Update profile api
     *
     * @return \Illuminate\Http\Response
     */

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required',
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $user_detail         = Auth::user();
        $user_detail->name   = $request->name;
        $user_detail->email  = $request->email;
        $user_detail->save();
        return $this->sendResponse('Profile updated successfully', '');   
    }



    /**
     * Change password  api
     *
     * @return \Illuminate\Http\Response
     */

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password'    => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $password = bcrypt($request['password']);
        $user_detail             = Auth::user();
        $user_detail->password   = $password;
        $user_detail->save();
        return $this->sendResponse('Password changed successfully', '');   
    }

    /**
     * Change password api
     *
     * @return \Illuminate\Http\Response
     */

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password'    => 'required',
            'mobile_no'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $password = bcrypt($request['password']);
        DB::table('users')->where('phone', $request['mobile_no'])->update(array('password'=>$password));
        return $this->sendResponse('Password updated successfully', '');   
    }

    /**
     * Get user profile api
     *
     * @return \Illuminate\Http\Response
     */

    public function getProfileDetail(){
        $success['user_detail'] = Auth::guard('api')->user();
        $success['profile_picture_base_url']  = config('app.url').'/assets/images/users/'.Auth::guard('api')->user()->profile_picture;
        return $this->sendResponse($success, 'Profile listed successfully.');   
    }

    /**
     * Get Home detail api
     *
     * @return \Illuminate\Http\Response
     */

    public function getHomeDetail(){
          $selectable = ['id','user_id','name','slug','features','colors','thumbnail','price','previous_price','attributes','size','size_price','discount_date'];
          $success['sliders']           = DB::table('sliders')->get();
          $success['top_small_banners'] = DB::table('banners')->where('type','=','TopSmall')->get();
          $success['discount_products'] = Product::with('user')->where('is_discount','=',1)->where('status','=',1)->orderBy('id','desc')->take(8)->get();
          $success['best_products']     = Product::with('user')->where('best','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();
          $success['top_products']      = Product::with('user')->where('top','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(8)->get();
          $success['big_products']      = Product::with('user')->where('big','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(6)->get();
          $success['hot_products']      = Product::with('user')->where('hot','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
          $success['latest_products']   = Product::with('user')->where('status','=',1)->orderBy('id','desc')->take(9)->get();
          $success['trending_products'] = Product::with('user')->where('trending','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
          $success['sale_products']     = Product::with('user')->where('sale','=',1)->where('status','=',1)->select($selectable)->orderBy('id','desc')->take(9)->get();
          return $this->sendResponse($success, 'Home product listed successfully.');   
    }


    /**
     * Get Dashboard detail api
     *
     * @return \Illuminate\Http\Response
     */

    public function getDashboardDetail(){
        $selectable = ['id','user_id','name','slug','features','colors','thumbnail','price','previous_price','attributes','size','size_price','discount_date'];
        $success['sliders']           = DB::table('app_sliders')->get();
        $success['slider_url']        = config('app.url').'/images/app_sliders/';
        $success['top_small_banners'] = DB::table('banners')->where('type','=','TopSmall')->get();
        $success['data_list']  = array(
                        '0'=>array('list_type'=>'product', 'name'=>'discount_products', 'type'=>'grid', 'bg_color'=>'#00FA9A', 'bg_image'=>'', 'count'=>'4', 'row_count'=>'2', 'image_list'=>'', 'product_list'=>Product::getDiscountedProductList()), 
                        '1'=>array('list_type'=>'image', 'name'=>'Sale', 'type'=>'image_list', 'bg_color'=>'#fff', 'bg_image'=>'', 'count'=>'2', 'row_count'=>'1', 'product_list'=>'', 'image_list'=>array('0'=>config('app.url').'/assets/images/banners/1568889151top2.jpg', '1'=>config('app.url').'/assets/images/banners/1568889146top1.jpg')), 
                        '2'=>array('list_type'=>'product', 'name'=>'top_products', 'type'=>'grid', 'bg_color'=>'#00BFFF', 'bg_image'=>'', 'count'=>'4',  'row_count'=>'2', 'image_list'=>'', 'product_list'=>Product::topRatedProductList()),
                        '3'=>array('list_type'=>'image', 'name'=>'Flash deal', 'type'=>'image_list', 'bg_color'=>'#fff', 'bg_image'=>'', 'count'=>'1', 'row_count'=>'1', 'product_list'=>'', 'image_list'=>array('0'=>config('app.url').'/assets/images/banners/1568889164bottom1.jpg')),  
                        '4'=>array('list_type'=>'product', 'name'=>'best_products', 'type'=>'slider', 'bg_color'=>'#FFB6C1', 'bg_image'=>'', 'count'=>'0', 'row_count'=>'0', 'image_list'=>'', 'product_list'=>Product::bestProductList()),
                        '5'=>array('list_type'=>'image', 'name'=>'Colloection', 'type'=>'image_list', 'bg_color'=>'#fff', 'bg_image'=>'', 'count'=>'3', 'row_count'=>'1', 'product_list'=>'', 'image_list'=>array('0'=>config('app.url').'/assets/images/banners/jpgwjewj1.jpg', '1'=>config('app.url').'/assets/images/banners/jpgsss3.jpg', '2'=>config('app.url').'/assets/images/banners/jpgsahbsahjdb2.jpg')),
                        '6'=>array('list_type'=>'product', 'name'=>'latest_products', 'type'=>'grid', 'bg_color'=>'#00FF7F',  'bg_image'=>'', 'count'=>'3', 'row_count'=>'3', 'image_list'=>'', 'product_list'=>Product::latestProductList()),
                        '7'=>array('list_type'=>'product', 'name'=>'trending_products', 'type'=>'grid', 'bg_color'=>'#00FFFF', 'bg_image'=>'', 'count'=>'4', 'row_count'=>'2', 'image_list'=>'', 'product_list'=>Product::trendingProductList()),
                        '8'=>array('list_type'=>'product', 'name'=>'sale_products', 'type'=>'grid', 'bg_color'=>'#a7b498', 'bg_image'=>'', 'count'=>'4', 'row_count'=>'2', 'image_list'=>'', 'product_list'=>Product::saleProductList()));
        $success['extra_data_list'] = array('flash_deal'=>Product::getDiscountedProductList(), 'partners'=>DB::table('partners')->get(), 'reviews'=>DB::table('reviews')->get(), 'blog'=>DB::table('blogs')->orderby('views','desc')->take(2)->get());
        return $this->sendResponse($success, 'Home product listed successfully.');   
    }



    /**
    * Get Category list api
    *
    * @return \Illuminate\Http\Response
    */
    public function getCategoryList(){
        $success['categories'] = Category::with('subs')->get();
        return $this->sendResponse($success, 'Category listed successfully.');   
    }



    /**
    * Get Product detail api
    *
    * @return \Illuminate\Http\Response
    */
    public function getProductDetail(Request $request){
        $validator = Validator::make($request->all(), [
            'slug'   => 'required'
        ]);
        $productt = Product::with('galleries')->where('slug','=',$request['slug'])->firstOrFail();
        if($productt->status == 0){
          return $this->sendError('Item not found!', '');
        }
        $productt->views+=1;
        $productt->update();
        $curr = Currency::where('is_default','=',1)->first();
        $product_click =  new ProductClick;
        $product_click->product_id = $productt->id;
        $product_click->date = Carbon::now()->format('Y-m-d');
        $product_click->save();
        $success['product']  = $productt;
        $success['currency'] = $curr;
        return $this->sendResponse($success, 'Product detail listed successfully.');     
    }



    /**
    * Add cart detail api
    *
    * @return \Illuminate\Http\Response
    */
    public function addCart(Request $request){
        $user  = Auth::user();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty'        => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $id = $request['product_id'];
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);
        $data = DB::table('languages')->where('is_default','=',1)->first();
        $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
        $lang = json_decode($data_results);
        $keys   = '';
        $values = '';
        if(!empty($prod->license_qty)){
            $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl){
                if($dtl < 1){
                    $lcheck = 0;
                }
                else{
                    $lcheck = 1;
                    break;
                }                    
            }
            if($lcheck == 0){
              return $this->sendError('Out of stock', '');        
            }
        }
        if($prod->user_id != 0){
            $gs = Generalsetting::findOrFail(1);
            $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission ;
            $prod->price = round($prc,2);
        }
        // Set Attribute
        if (!empty($prod->attributes)){
            $attrArr = json_decode($prod->attributes, true);
            $count = count($attrArr);
            $i = 0;
            $j = 0; 
            if (!empty($attrArr)){
                foreach ($attrArr as $attrKey => $attrVal){
                    if (is_array($attrVal) && array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1) {
                        if($j == $count - 1){
                            $keys .= $attrKey;
                        }
                        else{
                            $keys .= $attrKey.',';
                        }
                        $j++;
                        foreach($attrVal['values'] as $optionKey => $optionVal){
                            $values .= $optionVal . ',';
                            $prod->price += $attrVal['prices'][$optionKey];
                            break;
                        }
                    }
               }
            }
        }
        $item_info = array();
        $item_info['product_id']   = $prod->id;
        $item_info['user_id']      = $user->id;
        $item_info['qty']          = $request['qty'];
        $item_info['size']         = $request['product_size'];
        $item_info['amount']       = $request['price']*$request['qty'];
        $item_info['price']        = $request['price'];
        $item_info['items']        = $prod;
        $item_info['color']        = $request['color'];
        $item_info['cart_keys']    = $keys;
        $item_info['cart_values']  = $values;
        $item_info['created_at']   = date('Y-m-d h:i:s');
        Productcart::create($item_info);
        $notification_info = array();
        $notification_info['detail']   = $prod->name." has been added in cart";;
        $notification_info['user_id']  = $user->id;
        Notification::create($notification_info);
        return $this->sendResponse('Item added in cart successfully.', '');     
    }



    /**
    * Get cart detail api
    *
    * @return \Illuminate\Http\Response
    */
    public function getCartDetail(){
        $success['cart_detail'] = Productcart::join('products', 'products.id', '=', 'productcarts.product_id')->where('productcarts.is_active','=', '1')->where('productcarts.user_id','=', Auth::user()->id)->get(['products.*', 'productcarts.id as cart_id', 'productcarts.user_id', 'productcarts.product_id', 'productcarts.qty as cart_qty', 'productcarts.size as cart_size', 'productcarts.amount', 'productcarts.color as cart_color', 'productcarts.cart_keys as cart_keys', 'productcarts.cart_values as cart_values', 'productcarts.price as cart_price']);
        return $this->sendResponse($success, 'Cart detail listed successfully.');   
    }



    /**
    * Get cart qty api
    *
    * @return \Illuminate\Http\Response
    */
    public function updateCartqty(Request $request){
        $cart_detail = Productcart::find($request['cart_id']);
        $cart_detail->qty       = $request['qty'];
        $cart_detail->amount    = $request['qty']*$request['price'];
        $cart_detail->price     = $request['price'];
        $cart_detail->save();
        return $this->sendResponse('Cart updated successfully.', '');   
    }



    /**
    * Get cart qty api
    *
    * @return \Illuminate\Http\Response
    */

    public function removeCart(Request $request){
        $cart_detail = Productcart::find($request['cart_id']);
        $cart_detail->delete();
        return $this->sendResponse('Cart removed successfully.', '');   
    }

    /**
    * Add to wish list api
    *
    * @return \Illuminate\Http\Response
    */

    public function addToWishlist(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $check_wish_list = DB::table('wishlists')->where('product_id', $request['product_id'])->where('user_id', Auth::user()->id)->first(['id']);
        if(!empty($check_wish_list)){
            return $this->sendError('Product is already in wishlist', '');
        }
        else{
            $wish_list_info = array('product_id'=> $request['product_id'], 'user_id'=>Auth::user()->id);
            Wishlist::create($wish_list_info);
            return $this->sendResponse('Product added in wishlist successfully.', '');   
        }  
    }



    /**
    * Get wish list detail api
    *
    * @return \Illuminate\Http\Response
    */

    public function getWishList(){
        $success['wishlist_detail'] =  DB::table('wishlists')->join('products', 'products.id', '=', 'wishlists.product_id')->where('wishlists.user_id', Auth::user()->id)->get(['wishlists.product_id','products.*']);
        return $this->sendResponse($success, 'Wishlist detail listed successfully.');   
    }



    /**
    * Get remove from wishlist api
    *
    * @return \Illuminate\Http\Response
    */
    public function removeFromWishList(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required'
          ]);
  	    if ($validator->fails()) {
  	        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
  	    }
        $wishList_detail = DB::table('wishlists')->where('product_id', $request->id)->where('user_id', Auth::user()->id)->first(['id']);
        $detail = Wishlist::find($wishList_detail->id);
        $detail->delete();
        return $this->sendResponse('Product removed from wishlist successfully.', '');   
    }

    /**
    * Get category wise product list
    *
    * @return \Illuminate\Http\Response
    */

    public function getCategoryWiseProductList(Request $request){
        $validator   = Validator::make($request->all(), []);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $product_list     = DB::table('products')->where('category_id', $request['category_id'])->get();
        $success['product_list']  = $product_list;
        return $this->sendResponse($success, 'Product listed successfully.');   
    }


    /**
    * Get sub category wise product list
    *
    * @return \Illuminate\Http\Response
    */

    public function getSubcategoryWiseProductList(Request $request){
      $validator = Validator::make($request->all(), [
          'subcategory_id'   => 'required'
      ]);
      if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
      }
      $product_list = DB::table('products')->where('subcategory_id', $request['subcategory_id'])->get();
      $success['product_list']  = $product_list;
      return $this->sendResponse($success, 'Product listed successfully.');   
    }

    /**
    * Get coupon list  api
    *
    * @return \Illuminate\Http\Response
    */

    public function getCouponList(){
        $success['coupon_list'] =  DB::table('coupons')->where('status', '1')->get();
        return $this->sendResponse($success, 'Coupon listed successfully.');   
    }

    /**
    * Get shipping list  api
    *
    * @return \Illuminate\Http\Response
    */

    public function getShippingList(){
      $success['shipping_list'] =  DB::table('shippings')->get();
      return $this->sendResponse($success, 'Shipping listed successfully.');   
    }

    /**
    * Get packaging list  api
    *
    * @return \Illuminate\Http\Response
    */

    public function getPackagingList(){
        $success['packaging_list'] =  DB::table('packages')->get();
        return $this->sendResponse($success, 'Packaging detail listed successfully.');   
    }


    /**
    * Checkout api
    *
    * @return \Illuminate\Http\Response
    */
    public function checkout(Request $request){
        $cart     = DB::table('productcarts')->where('user_id', Auth::user()->id)->get();
        if($request->method=='Cash On Delivery'){
            $payment_method = 'Cash On Delivery';
            $status         = 'Confirmed';
            $item_number = Auth::user()->id.(Str::random(10));
        }
        else{
            $payment_method = 'Razorpay';
            $api = new Api('rzp_live_saKX1f6HEAa7tY', '2qPF4DyHbWwWSoGt1oma2tU1');
            $item_number = Auth::user()->id.(Str::random(10));
            $orderData = [
                'receipt'         => $item_number,
                'amount'          => $request->pay_amount * 100, // 2000 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            $razorpayOrder = $this->api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];
            $success['razorpay_order_id']  =  $razorpayOrderId;
            $success['receipt']            =  $item_number;
            $success['amount']             =  $request->pay_amount * 100;
            $success['currency']           =  'INR';
            $success['payment_capture']    =  1;
            $status                        = 'Pending';
        }  
        $order_info = array();
        $order_info['user_id']            = Auth::user()->id;
        $order_info['cart']               = $cart;
        $order_info['cart_itmes']         = $cart; 
        $order_info['totalQty']           = $request->total_qty;
        $order_info['pay_amount']         = $request->pay_amount;
        $order_info['method']             = $payment_method;
        $order_info['shipping']           = $request->shipping;
        $order_info['pickup_location']    = $request->pickup_location;
        $order_info['customer_email']     = $request->email;
        $order_info['customer_name']      = $request->name;
        $order_info['shipping_cost']      = $request->shipping_cost;
        $order_info['packing_cost']       = $request->packing_cost;
        $order_info['tax']                = '0';
        $order_info['customer_phone']     = $request->phone;
        $order_info['order_number']       = $item_number;
        $order_info['customer_address']   = $request->address;
        $order_info['customer_country']   = $request->customer_country;
        $order_info['customer_city']      = $request->city;
        $order_info['customer_zip']       = $request->zip;
        $order_info['shipping_email']     = $request->shipping_email;
        $order_info['shipping_name']      = $request->shipping_name;
        $order_info['shipping_phone']     = $request->shipping_phone;
        $order_info['shipping_address']   = $request->shipping_address;
        $order_info['shipping_country']   = $request->shipping_country;
        $order_info['shipping_city']      = $request->shipping_city;
        $order_info['shipping_zip']       = $request->shipping_zip;
        $order_info['order_note']         = $request->order_notes;
        $order_info['coupon_code']        = $request->coupon_code;
        $order_info['coupon_discount']    = $request->coupon_discount;
        $order_info['payment_status']     = $status;
        // $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        // $order['vendor_packing_id']  = $request->vendor_packing_id;
        try {
            $order_detail = Order::create($order_info);  
        }
        catch(\Exception $e) {
            return $this->sendError($e, '');
        }
        foreach ($cart as $key => $single_cart) {
            $pro_detail  = Product::where('id', $single_cart->product_id)->first();
            $suborder_info = array();
            $suborder_info['user_id']            = Auth::user()->id;
            $suborder_info['order_id']           = $order_detail->id;
            $suborder_info['item_id']            = $single_cart->product_id; 
            $suborder_info['vendor_id']          = $pro_detail->user_id;
            $suborder_info['price']              = $single_cart->price;
            $suborder_info['qty']                = $single_cart->qty;
            $suborder_info['size']               = $single_cart->size;
            $suborder_info['amount']             = $single_cart->amount;
            $suborder_info['color']              = $single_cart->color;
            $suborder_info['cart_keys']          = $single_cart->cart_keys;
            $suborder_info['cart_values']        = $single_cart->cart_values;
            $suborder_info['order_date']         = $order_detail->created_at;
            $suborder_info['shipping_name']      = $request->shipping_name;
            $suborder_info['shipping_country']   = $request->shipping_country;
            $suborder_info['shipping_email']     = $request->shipping_email;
            $suborder_info['shipping_phone']     = $request->shipping_phone;
            $suborder_info['shipping_address']   = $request->shipping_address;
            $suborder_info['shipping_city']      = $request->shipping_city;
            $suborder_info['shipping_zip']       = $request->shipping_zip;
            $suborder_info['status']             = 'pending';
            $suborder_info['payment_status']     = $status;
            try {
              Suborder::create($suborder_info);  
            }
            catch(\Exception $e) {
              return $this->sendError($e, '');
            }
        }
        $get_vendor_list = DB::table('suborders')->where('order_id', $order_detail->id)->groupBy('vendor_id')->get();
        foreach ($get_vendor_list as $key => $vandor) {
        	$invoice_no  = 'ORD00'.Auth::user()->id.$vandor->vendor_id.(Str::random(15)).$order_detail->id;
        	Suborder::where('order_id', $order_detail->id)->where('vendor_id', $vandor->vendor_id)->update(['invoice_no'=>$invoice_no]);            	
        }
        Suborder::where('order_id', $order_detail->id)->where('vendor_id', $vandor->vendor_id)->update(['invoice_no'=>$invoice_no]);
        DB::table('productcarts')->where('is_active', '1')->where('order_id', '0')->update(['order_id' =>$order_detail->id, 'is_active'=>'0']);
        $order_track = array();
        $order_track['title']      = 'Pending';
        $order_track['text']       = 'You have successfully placed your order.';
        $order_track['order_id']   = $order_detail->id;
        $order_track  = OrderTrack::create($order_track);
        $notification = new Notification;
        $notification->order_id = $order_detail->id;
        $notification->save();
        if($request->coupon_id != ""){
            $coupon = Coupon::findOrFail($request->coupon_id);
            $coupon->used++;
            if($coupon->times != null){
                $i = (int)$coupon->times;
                $i--;
                $coupon->times = (string)$i;
            }
            $coupon->update();
        }
        if($request->method=='Cash On Delivery'){
            $message = "Dear ".Auth::user()->name." You have placed new order on ".config('app.name').". Your Order Number is ".$order_detail->order_number.' of amount INR/'.$request->pay_amount;
            $this->sendPushNotification($message, Auth::user()->fire_base_token);
        }
        $pdf_file_name  = $this->generateOrderPdf($order_detail->id);
        $this->sendmail($pdf_file_name, $order_detail->order_number);

        $success['razorpay_key']    =  'rzp_live_saKX1f6HEAa7tY';
        $success['razorpay_secret'] =  '2qPF4DyHbWwWSoGt1oma2tU1';
        return $this->sendResponse($success, 'Order places successfully.');   
    }

    /**
    * razor call back api
    *
    * @return \Illuminate\Http\Response
    */
    public function razorCallback(Request $request){
        $validator = Validator::make($request->all(), [
            'razorpay_order_id'   => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature'  => 'required',
            'receipt'             => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $attributes = array(
            'razorpay_order_id'   => $request['razorpay_order_id'],
            'razorpay_payment_id' => $request['razorpay_payment_id'],
            'razorpay_signature'  => $request['razorpay_signature']
        );
        try{
            $this->api->utility->verifyPaymentSignature($attributes);
        }
        catch(SignatureVerificationError $e){
            return $this->sendError($e->getMessage(), '');
        }
        DB::table('orders')->where('order_number', $request['receipt'])->update(['txnid' =>$request['razorpay_payment_id'], 'payment_status'=>'completed', 'status'=>'completed']);
        $order = Order::where( 'order_number', $request['receipt'])->first();
        $message = "You have successfully create order on ".config('app.name').". your order no is ".$request['receipt'];
        $this->sendPushNotification($message, Auth::user()->fire_base_token);
        $this->sendSms(Auth::user()->phone, $message);
        return $this->sendResponse('Order Completed successfully.', '');       
    }


    /**
    * Get order list  api
    *
    * @return \Illuminate\Http\Response
    */

    public function orderDetail(){
        $success['order_detail'] =  DB::table('orders')->where('user_id', Auth::user()->id)->get(['id', 'user_id', 'method', 'shipping', 'pickup_location',  'totalQty', 'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status', 'customer_email', 'customer_name', 'customer_country', 'customer_phone', 'customer_address', 'customer_city', 'customer_zip', 'shipping_name', 'shipping_country', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip', 'order_note', 'coupon_code', 'coupon_discount', 'status', 'created_at', 'updated_at', 'affilate_user', 'affilate_charge', 'currency_sign', 'currency_sign', 'shipping_cost', 'packing_cost', 'tax', 'dp', 'pay_id', 'vendor_shipping_id', 'vendor_packing_id']);
        return $this->sendResponse($success, 'Order detail listed successfully.');   
    }



    /**
    * Get order item detail  api
    *
    * @return \Illuminate\Http\Response
    */
    public function orderItemDetail(Request $request){
        $user_order_list = DB::table('orders')->where('id', $request->order_id)->get('cart_itmes');
        $success['order_detail']      =  DB::table('orders')->where('id', $request->order_id)->get(['id', 'user_id', 'method', 'shipping', 'pickup_location',  'totalQty', 'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status', 'customer_email', 'customer_name', 'customer_country', 'customer_phone', 'customer_address', 'customer_city', 'customer_zip', 'shipping_name', 'shipping_country', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip', 'order_note', 'coupon_code', 'coupon_discount', 'status', 'created_at', 'updated_at', 'affilate_user', 'affilate_charge', 'currency_sign', 'currency_sign', 'shipping_cost', 'packing_cost', 'tax', 'dp', 'pay_id', 'vendor_shipping_id', 'vendor_packing_id']);
        $success['order_item_detail'] = Productcart::join('products', 'products.id', '=', 'productcarts.product_id')->where('productcarts.is_active','=', '0')->where('productcarts.order_id','=',$request->order_id)->get(['products.*', 'productcarts.id as cart_id', 'productcarts.user_id', 'productcarts.product_id', 'productcarts.qty as cart_qty', 'productcarts.size as cart_size', 'productcarts.amount', 'productcarts.color as cart_color', 'productcarts.cart_keys as cart_keys', 'productcarts.cart_values as cart_values', 'productcarts.price as cart_price']);
        return $this->sendResponse($success, 'Order item detail listed successfully.');   
    }


    /**
    * Get searched product list
    *
    * @return \Illuminate\Http\Response
    */

    public function searchProduct(Request $request){
        $product_list     = DB::table('products')->where('name', 'like', '%' . $request->search_key . '%')->get();
        $success['product_list']  = $product_list;
        return $this->sendResponse($success, 'Product listed successfully.');   
    }

    /**
    * Get general setting  api
    *
    * @return \Illuminate\Http\Response
    */
    public function getGeneralSetting(){
        $success['razorpay_key']    =  'rzp_live_saKX1f6HEAa7tY';
        $success['razorpay_secret'] =  '2qPF4DyHbWwWSoGt1oma2tU1';
        return $this->sendResponse($success, 'General setting listed successfully.');   
    }


    /**
    * Save Address api
    *
    * @return \Illuminate\Http\Response
    */

    public function saveAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name'   => 'required',
            'phone_no'   => 'required',
            'email'   => 'required',
            'address'   => 'required',
            'country'   => 'required',
            'city'   => 'required',
            'postal_code'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $detail = array('full_name'=> $request['full_name'], 'phone_no'=> $request['phone_no'], 'email'=> $request['email'], 'address'=> $request['address'],  'country'=> $request['country'], 'city'=> $request['city'], 'user_id'=>Auth::user()->id, 'postal_code'=> $request['postal_code']);
        Address::create($detail);
        return $this->sendResponse('Address added successfully.', '');     
    }





    /**
     * updateAddress Address api
     *
     * @return \Illuminate\Http\Response
     */

    public function updateAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required',
            'phone_no'      => 'required',
            'email'         => 'required',
            'address'       => 'required',
            'country'       => 'required',
            'city'          => 'required',
            'id'            => 'required',
            'postal_code'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $detail = array('full_name'=> $request['full_name'], 'phone_no'=> $request['phone_no'], 'email'=> $request['email'], 'address'=> $request['address'],  'country'=> $request['country'], 'city'=> $request['city'], 'user_id'=>Auth::user()->id, 'postal_code'=> $request['postal_code']);
        DB::table('addresses')->where('id', $request['id'])->update($detail);
        return $this->sendResponse('Address updated successfully.', '');     
    }


    /**
    * removeAddress Address api
    *
    * @return \Illuminate\Http\Response
    */

    public function removeAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        DB::table('addresses')->where('id', $request['id'])->delete();
        return $this->sendResponse('Address removed successfully.', '');     
    }


    /**
    * getAddress Address api
    *
    * @return \Illuminate\Http\Response
    */
    public function getAddress(){
        $address_detail = DB::table('addresses')->where('user_id', Auth::user()->id)->get();
        $success['address_list']  = $address_detail;
        return $this->sendResponse($success, 'Address listed successfully');     
    }


    /**
    * get notification  api
    *
    * @return \Illuminate\Http\Response
    */
    public function getNotification(Request $request){
        $success['notification']  = DB::table('notifications')->where('user_id', Auth::user()->id)->where('is_read', '0')->orderBy('id', 'desc')->limit('10')->get('detail');
        return $this->sendResponse($success, 'Notification listed successfully');     
    }


    /**
    * Change profile picture api
    *
    * @return \Illuminate\Http\Response
    */
    public function changeProfilePicture(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_picture'   => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $binary   = base64_decode($request['profile_picture']);
        header('Content-Type: bitmap; charset=utf-8');
        $filename = 'assets/images/users/'.time().rand(1,100000000).'.jpg';
        $file     = fopen($filename, 'wb');
        fwrite($file, $binary);
        fclose($file);
        DB::table('users')->where('id', Auth::user()->id)->update(['profile_picture'=>$filename]);
        // DB::table('addresses')->where('id', $request['id'])->delete();
        return $this->sendResponse('Profile picture changed successfully.', '');     
    }

    /**
    * Save reviews and ratings api
    *
    * @return \Illuminate\Http\Response
    */
    public function saveReviewsAndratings(Request $request){
        $validator = Validator::make($request->all(), [
          'product_id' => 'required',
          'review'     => 'required',
          'rating'     => 'required'
        ]);
        if ($validator->fails()){
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $detail = array('product_id'=>$request['product_id'], 'review'=>$request['review'], 'rating'=>$request['rating'], 'review_date'=>date('Y-m-d H:i:s'), 'user_id'=>Auth::user()->id);
        Rating::create($detail);
        return $this->sendResponse('Rating saved successfully.', '');     
    }


    /**
    * Get reviews and rating api
    *
    * @return \Illuminate\Http\Response
    */
    public function getReviewsAndratings(Request $request){
        $validator = Validator::make($request->all(), [
          'product_id' => 'required'
        ]);
        if ($validator->fails()){
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $success['reviews_and_rating_list'] = DB::table('ratings')->join('users', 'users.id', '=', 'ratings.user_id')->where('ratings.product_id', $request['product_id'])->orderBy('ratings.id', 'desc')->get(['ratings.review', 'ratings.rating', 'ratings.review', 'ratings.review_date', 'users.name', 'users.profile_picture']);
        return $this->sendResponse($success, 'Listed successfully');     
    }

    /**
    * Get popular tags api
    *
    * @return \Illuminate\Http\Response
    */
    public function getPopularTags(Request $request){
    	$validator = Validator::make($request->all(), [
          'category_id' => 'required'
        ]);
        if ($validator->fails()){
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $success['popular_tag_list'] = Product::showTagsCategoryWise($request['category_id']);
        return $this->sendResponse($success, 'Listed successfully');     
    }

    /**

     * Get filter product list
     *
     * @return \Illuminate\Http\Response
     */

    public function filterProduct(Request $request){
        $category_id    = $request['category_id'];
        $subcategory_id = $request['subcategory_id'];
        $category_id    = $request['category_id'];
        $tag            = $request['tag'];
        $rating         = $request['rating'];
		    $product_list	  = DB::table('products')
					    ->when($category_id, function ($query) use ($category_id) {
					        return $query->where('category_id', $category_id);
					    })
					    ->when($subcategory_id, function ($query) use ($subcategory_id) {
					        return $query->where('subcategory_id', $subcategory_id);
					    })
					    ->when($tag, function($query) use ($tag) {
					        return $query->where('tags','LIKE','%'.$tag.'%');
					    })
					    ->when($rating, function($query) use ($rating) {
					    	  $product_ids  = Rating::where('rating', $rating)->get();
				          $product_id_array = array();
				          foreach ($product_ids as $key => $product_id_val) {
				            array_push($product_id_array, $product_id_val->product_id);
				          }
				          $product_id_array = (!empty($product_id_array))?$product_id_array:['0'];
					        return $query->whereIn('id',$product_id_array);
					    })->get();
        $success['product_list']  = $product_list;
        return $this->sendResponse($success, 'Product listed successfully.');   
    }

    /**
     * Get filter attributes api
     *
     * @return \Illuminate\Http\Response
    */
    public function getFilterAttributes(Request $request){
    	  $validator = Validator::make($request->all(), [
          'category_id' => 'required'
        ]);

        if ($validator->fails()){
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        $success['attribute_list'] = array('tag'=>array("attribute"=>'tag', "detail"=>Product::showTagsCategoryWise($request['category_id'])),
        'size'=>array("attribute"=>'size', "detail"=>Product::getSizeByCategoryId($request['category_id'])), 'price'=>array("attribute"=>'price', "detail"=>array('min_price_100', 'max_price_100000')), 'color'=>array("attribute"=>'color', "detail"=>array('#F0F8FF', '#A52A2A', '#7FFF00', '#6495ED')), 'rating'=>array("attribute"=>'rating', "detail"=>""));
        return $this->sendResponse($success, 'Listed successfully');     
    }

    /**
     * Download order invoice api
     *
     * @return \Illuminate\Http\Response
    */
    public function downloadOrderInvoice(Request $request){
        $validator   = Validator::make($request->all(), [
          'order_id' => 'required'
        ]);
        if ($validator->fails()){
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $pdf_file_name        = $this->generateOrderPdf($request['order_id']);
        $success['file_path'] = config('app.url')."/invoice_pdf/".$pdf_file_name;
        return $this->sendResponse($success, 'Listed successfully');     
    }

    /**
     * Get items count
     *
     * @return \Illuminate\Http\Response
    */
    public function getItemsCount(){
        $success['cart_item_count'] = DB::table('productcarts')->where('user_id', Auth::user()->id)->where('order_id', '0')->count();
        $success['wishlists_count'] = DB::table('wishlists')->where('user_id', Auth::user()->id)->count();
        return $this->sendResponse($success, 'Listed successfully');
    }



    /**
     * Get user order list item wise  api
     *
     * @return \Illuminate\Http\Response
    */
    public function getUserOrderItemWise(){
        $order_item_list =  DB::table('productcarts')->join('products', 'products.id', '=', 'productcarts.product_id')->join('orders', 'orders.id', '=', 'productcarts.order_id')->where('productcarts.user_id', Auth::user()->id)->where('productcarts.order_id', '!=',  '')->orderBy('productcarts.id', 'desc')->limit('10')->get(['productcarts.id as cart_item_id', 'productcarts.user_id', 'productcarts.product_id', 'productcarts.price', 'productcarts.qty', 'productcarts.size', 'productcarts.amount', 'productcarts.color', 'productcarts.cart_keys', 'productcarts.cart_values', 'productcarts.order_id', 'productcarts.created_at', 'products.photo', 'products.slug', 'orders.method', 'orders.payment_status', 'orders.status', 'orders.order_number', 'products.name', 'productcarts.status as product_status']);
        $success['order_item_list']  = $order_item_list;
        return $this->sendResponse($success, 'Order item detail listed successfully.');   
    }


    /**
     * cancel Order Address api
     *
     * @return \Illuminate\Http\Response
    */
    public function cancelOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $order =  DB::table('orders')->where('id', $request->order_id)->first();
        if(!empty($request->item_id)){
            $data = array('bank_name'=>(isset($request['bank_name']) && $request['bank_name'] !="") ? $request['bank_name'] : "", 'account_holder_name'=>(isset($request['account_holder_name']) && $request['account_holder_name'] !="") ? $request['account_holder_name'] : "", 'account_number'=>(isset($request['account_number']) && $request['account_number'] !="") ? $request['account_number'] : "", 'ifsc_code'=>(isset($request['ifsc_code']) && $request['ifsc_code'] !="") ? $request['ifsc_code'] : "", 'reason'=>$request['reason']);
            $order_item_detail =  DB::table('productcarts')->where('product_id', $request->item_id)->where('order_id', $request->order_id)->first();
            DB::table('productcarts')->where('product_id', $request->item_id)->where('order_id', $request->order_id)->update(array('reason'=>$request->reason, 'status'=>'declined'));
            $item_tot_price = $order_item_detail->price*$order_item_detail->qty;
            $updated_amount = $order->pay_amount - $item_tot_price;
            DB::table('orders')->where('id', $request['order_id'])->update(['order_cancellation_detail'=>json_encode($data), 'pay_amount'=>$updated_amount]);
        }
        else{
            $data = array('bank_name'=>(isset($request['bank_name']) && $request['bank_name'] !="") ? $request['bank_name'] : "", 'account_holder_name'=>(isset($request['account_holder_name']) && $request['account_holder_name'] !="") ? $request['account_holder_name'] : "", 'account_number'=>(isset($request['account_number']) && $request['account_number'] !="") ? $request['account_number'] : "", 'ifsc_code'=>(isset($request['ifsc_code']) && $request['ifsc_code'] !="") ? $request['ifsc_code'] : "", 'reason'=>$request['reason']);
            DB::table('orders')->where('id', $request['order_id'])->update(['order_cancellation_detail'=>json_encode($data), 'status'=>'declined']);
        }
        return $this->sendResponse('Order cancelled successfully.', '');     
    }

    public function delhivery_shipping_creds(){
        $success['base_url']  = "https://staging-express.delhivery.com/c/api/pin-codes/json/?token=80a851bf8ce9ce5c00bd9b9ed098e047a41d1975&filter_codes=";
        return $this->sendResponse($success, 'success.');   
    }


    /**
    * Check delivery avalibality api
    *
    * @return \Illuminate\Http\Response
    */
    public function checkDeliveryAvalibality(Request $request){
        $validator   = Validator::make($request->all(), [
          'postal_code' => 'required'
        ]);
        if ($validator->fails()){
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $url = 'https://staging-express.delhivery.com/c/api/pin-codes/json/?token=80a851bf8ce9ce5c00bd9b9ed098e047a41d1975&filter_codes='.$request['postal_code'];
        $data = json_decode(file_get_contents($url), true);
        if(!empty($data['delivery_codes'])){
          $success['delivery_availability']  = 'Y';
          $success['cod']                    = $data['delivery_codes']['0']['postal_code']['cod'];
        }
        else{
          $success['delivery_availability']  = 'N';
          $success['cod']                    = 'N';
        }
        
        return $this->sendResponse($success, 'success');     
    }
}
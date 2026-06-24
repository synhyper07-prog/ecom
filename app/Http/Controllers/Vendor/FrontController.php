<?php

namespace App\Http\Controllers\Vendor;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Counter;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Markury\MarkuryPost;
use App\Models\SellerShippingFee;
use App\Models\Currency;
use App\Models\Otp;
use App\Models\SellerFaq;
use App\Models\SellerFaqsChild;
use App\Models\CollectionPrice;
use App\Models\FixedFee;
use Auth;

class FrontController extends Controller{
    public function __construct(){
        
    }

    function getOS() {
        $user_agent     =   !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Unknown";
        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }
        return $os_platform;
    }

	public function index(){
        if(Auth::guard('web')->check()){
            if(Auth::user()->is_vendor== 0){
                return redirect()->route('front.index');
            }
        }
	    return view('vendor.front.index');
	}

    public function feeStructure(){
        $currency = Currency::findOrFail(1);
        $data = SellerShippingFee::where('is_active','=','1')->get();
        return view('vendor.front.seller-fee-structure', compact('data'), compact('currency'));
    }

    public function vendorFaq(){
        $data = SellerFaq::with('list')->get();
        return view('vendor.front.seller-faq', compact('data'));
    }

    public function resources(){
        return view('vendor.front.seller-resources');
    }

    public function services(){
        return view('vendor.front.seller-services');
    }

    public function vendorFaqById($id){
        $data = SellerFaqsChild::where('seller_faq_id','=',$id)->get();
        return view('vendor.front.faq-by-id', compact('data'));
    }
}

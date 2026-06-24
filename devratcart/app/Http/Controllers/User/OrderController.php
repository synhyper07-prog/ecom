<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function orders(){
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.order.index',compact('user','orders'));
    }

    public function ordertrack(){
        $user = Auth::guard('web')->user();
        return view('user.order-track',compact('user'));
    }

    public function trackload($id){
        $order = Order::where('order_number','=',$id)->first();
        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load',compact('order','datas'));
    }

    public function order($id){
        $user = Auth::guard('web')->user();
        $order = Order::findOrfail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.details',compact('user','order','cart'));
    }

    public function orderdownload($slug,$id){
        $user = Auth::guard('web')->user();
        $order = Order::where('order_number','=',$slug)->first();
        $prod = Product::findOrFail($id);
        if(!isset($order) || $prod->type == 'Physical' || $order->user_id != $user->id){
            return redirect()->back();
        }
        return response()->download(public_path('/actual_path/assets/files/'.$prod->file));
    }

    public function orderPdfDownload($id){
        $user  = Auth::guard('web')->user();
        $order = Order::findOrfail($id);
        $cart  = unserialize(bzdecompress(utf8_decode($order->cart)));
        
        $pdf   = PDF::loadView('user.order.download-order-pdf',compact('user','order','cart'));
        // download PDF file with download method

        return $pdf->download('order'.$order->order_number.'.pdf');
    }

    public function orderprint($id){
        $user = Auth::guard('web')->user();
        $order = Order::findOrfail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.print',compact('user','order','cart'));
    }

    public function trans(){
        $id = $_GET['id'];
        $trans = $_GET['tin'];
        $order = Order::findOrFail($id);
        $order->txnid = $trans;
        $order->update();
        $data = $order->txnid;
        return response()->json($data);            
    }

    public function cancel(Request $request){
        $data = array('bank_name'=>(isset($request['bank_name']) && $request['bank_name'] !="") ? $request['bank_name'] : "", 'account_holder_name'=>(isset($request['account_holder_name']) && $request['account_holder_name'] !="") ? $request['account_holder_name'] : "", 'account_number'=>(isset($request['account_number']) && $request['account_number'] !="") ? $request['account_number'] : "", 'ifsc_code'=>(isset($request['ifsc_code']) && $request['ifsc_code'] !="") ? $request['ifsc_code'] : "", 'reason'=>$request['reason'], 'cancellation_question'=>$request['cancellation_question']);
        DB::table('orders')->where('id', $request['order_id'])->update(['order_cancellation_detail'=>json_encode($data), 'status'=>'declined']);
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.order.index',compact('user','orders'));
    }  
}


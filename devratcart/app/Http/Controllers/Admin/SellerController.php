<?php

namespace App\Http\Controllers\Admin;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Counter;
use App\Models\Generalsetting;
use App\Models\User;
use App\Models\SellerShippingFee;
use Carbon\Carbon;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\CollectionPrice;
use App\Models\FixedFee;
use App\Models\SellerFaq;
use App\Models\SellerFaqsChild;
use InvalidArgumentException;
use Datatables;
use Validator;


class SellerController extends Controller{
    public function __construct(){
        
    }

	public function index(){
        $currency = Currency::findOrFail(1);
        $data = SellerShippingFee::where('is_active','=','1')->get();
	    return view('admin.seller.index', compact('data'), compact('currency'));
	}

    public function postPriceSlab(Request $request){
        $rules = [ 'slab_name'   => 'required', 'local_intracity' => 'required', 'zonal_intrazone' => 'required', 'national_interzone' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $input = array('weight_slab'=>$request->slab_name, 'local'=>$request->local_intracity, 'zonal'=>$request->zonal_intrazone, 'national'=>$request->national_interzone);
        SellerShippingFee::Create($input);
        return redirect('admin/seller-shipping-fee')->with('message', 'Slab added successfully');
    }

    public function collection(){
        $data = CollectionPrice::get();
        return view('admin.seller.collection', compact('data'));
    }

    public function postCollection(Request $request){
        $rules = [ 'slab_name'   => 'required', 'local_intracity' => 'required', 'zonal_intrazone' => 'required', 'national_interzone' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $input = array('weight_slab'=>$request->slab_name, 'local'=>$request->local_intracity, 'zonal'=>$request->zonal_intrazone, 'national'=>$request->national_interzone);
        SellerShippingFee::Create($input);
        return redirect('admin/seller-shipping-fee')->with('message', 'Slab added successfully');
    }


    public function sellerFaqList(){
        $data = SellerFaq::get();
        return view('admin.seller.seller-faq-list', compact('data'));
    }

    public function sellerFaqForm(){
        return view('admin.seller.seller-faq-form');
    }

    public function postSellerFaq(Request $request){
        $input_faq_heading = array('heading'=>$request->heading);
        $seller_faq = SellerFaq::Create($input_faq_heading);
        foreach ($request['sub_heading'] as $key => $value) {
            $input_faq_detail = array('seller_faq_id'=>$seller_faq->id, 'sub_heading'=>$value, 'detail'=>$request->details[$key]);
            SellerFaqsChild::Create($input_faq_detail);
        }
        return redirect('admin/seller-faq-list')->with('message', 'Faq added successfully');
    }

    public function sellerEditFaqForm($id){
        $data = SellerFaq::where('id', $id)->with('list')->first();
        return view('admin.seller.edit-seller-faq-form', compact('data'));
    }

    public function updateSellerFaq(Request $request){
        SellerFaqsChild::where('seller_faq_id', $request->seller_faq_id)->delete();
        SellerFaq::where('id', $request->seller_faq_id)->delete();
        $input_faq_heading = array('heading'=>$request->heading);
        $seller_faq = SellerFaq::Create($input_faq_heading);
        foreach ($request['sub_heading'] as $key => $value) {
            $input_faq_detail = array('seller_faq_id'=>$seller_faq->id, 'sub_heading'=>$value, 'detail'=>$request->details[$key]);
            SellerFaqsChild::Create($input_faq_detail);
        }
        return redirect('admin/seller-faq-list')->with('message', 'Faq updated successfully');
    }

    public function sellerFaqDetail($id){
        $data = SellerFaq::where('id', $id)->with('list')->first();
        return view('admin.seller.view-seller-faq-detail', compact('data'));
    }

    public function deleteSellerFaq($id){
        SellerFaqsChild::where('seller_faq_id', $id)->delete();
        SellerFaq::where('id', $id)->delete();
        return redirect('admin/seller-faq-list')->with('message', 'Faq deleted successfully');
    }
}

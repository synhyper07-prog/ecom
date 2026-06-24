@extends('layouts.front')

@section('content')

<!-- User Dashbord Area Start -->

<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="order-details">
                        <div class="process-steps-area">@include('includes.order-process')</div>
                        <div class="header-area"><h4 class="title">{{ $langg->lang284 }}</h4></div>
                        <div class="view-order-page">
                            <div class="edit-account-info-div">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <img src="http://ratcart.com/assets/images/1608292812ratcart.png" alt>
                                    </div>
                                    <div class="col-lg-6" style="text-align: right !important;">
                                        <a class="back-btn" href="{{ route('user-orders') }}">{{ $langg->lang318 }}</a>
                                        <a class="back-btn" href="{{ route('user-order-pdf-download',$order->id) }}">Download</a>
                                        <a href="{{route('user-order-print',$order->id)}}" target="_blank" class="back-btn" style="background: #1562b0 !important;"><i class="fa fa-print"></i> {{ $langg->lang286 }}</a>
                                    </div>
                                    <h3 class="order-code"><br>{{ $langg->lang285 }} {{$order->order_number}} [{{$order->status}}]</h3>  
                                </div>
                            </div>
                            <p class="order-date">{{ $langg->lang301 }} {{date('d-M-Y',strtotime($order->created_at))}}</p>
                            @if($order->dp == 1)
                                <div class="billing-add-area">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>{{ $langg->lang287 }}</h5>
                                            <address>
                                                {{ $langg->lang288 }} {{$order->customer_name}}<br>
                                                {{ $langg->lang289 }} {{$order->customer_email}}<br>
                                                {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                                                {{ $langg->lang291 }} {{$order->customer_address}}<br>
                                                @if($order->order_note != null)
                                                {{ $langg->lang801 }}: {{$order->order_note}}<br>
                                                @endif
                                                {{$order->customer_city}}-{{$order->customer_zip}}
                                            </address>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>{{ $langg->lang292 }}</h5>
                                            <p>{{ $langg->lang798 }}:
                                                {!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
                                            </p>
                                            <p>{{ $langg->lang293 }}
                                                {{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}
                                            </p>
                                            <p>{{ $langg->lang294 }} {{$order->method}}</p>
                                            @if($order->method != "Cash On Delivery")
	                                            @if($order->method=="Stripe")
	                                               {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
	                                            @endif
                                            {{$order->method}} {{ $langg->lang296 }} <p id="ttn">{{$order->txnid}}</p>
                                            <a id="tid" style="cursor: pointer;" class="mybtn2">{{ $langg->lang297 }}</a> 
                                            <form id="tform">
                                                <input style="display: none; width: 100%;" type="text" id="tin" placeholder="{{ $langg->lang299 }}" required="" class="mb-3">
                                                <input type="hidden" id="oid" value="{{$order->id}}">
                                                <button style="display: none; padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tbtn" type="submit" class="mybtn1">{{ $langg->lang300 }}</button>
                                                <a style="display: none; cursor: pointer;  padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tc"  class="mybtn1">{{ $langg->lang298 }}</a>
                                                {{-- Change 1 --}}
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="shipping-add-area">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($order->shipping == "shipto")
                                            <h5>{{ $langg->lang302 }}</h5>
                                            <address>
                                                {{ $langg->lang288 }}
                                                {{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}<br>
                                                {{ $langg->lang289 }}
                                                {{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}<br>
                                                {{ $langg->lang290 }}
                                                {{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}<br>
                                                {{ $langg->lang291 }}
                                                {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                                                {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}-{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}
                                            </address>
                                            @else
                                            <h5>{{ $langg->lang303 }}</h5>
                                            <address>
                                                {{ $langg->lang304 }} {{$order->pickup_location}}<br>
                                            </address>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <h5>{{ $langg->lang305 }}</h5>
                                            @if($order->shipping == "shipto")
                                                <p>{{ $langg->lang306 }}</p>
                                                @else
                                                    <p>{{ $langg->lang307 }}</p>
                                                @endif

                                                @if($order->shipping_cost != 0)
	                                                @php 
	                                                $price = round(($order->shipping_cost / $order->currency_value),2);
	                                                @endphp
                                                @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                                                    <p>{{ DB::table('shippings')->where('price','=',$price)->first()->title }}: {{$order->currency_sign}}{{ round($order->shipping_cost, 2) }}</p>
                                                @endif
                                            @endif
                                            @if($order->packing_cost != 0)
                                                @php 
                                                  $pprice = round(($order->packing_cost / $order->currency_value),2);
                                                @endphp
                                                @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
                                                   <p>{{ DB::table('packages')->where('price','=',$pprice)->first()->title }}: {{$order->currency_sign}}{{ round($order->packing_cost, 2) }}</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="billing-add-area">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>{{ $langg->lang287 }}</h5>
                                            <address>
                                                {{ $langg->lang288 }} {{$order->customer_name}}<br>
                                                {{ $langg->lang289 }} {{$order->customer_email}}<br>
                                                {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                                                {{ $langg->lang291 }} {{$order->customer_address}}<br>
                                                @if($order->order_note != null){{ $langg->lang801 }}: {{$order->order_note}}<br>@endif{{$order->customer_city}}-{{$order->customer_zip}}
                                            </address>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>{{ $langg->lang292 }}</h5>
                                            <p>
                                                {{ $langg->lang798 }}{!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
                                            </p>
                                            <p>{{ $langg->lang293 }}
                                                {{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}
                                            </p>
                                            <p>{{ $langg->lang294 }} {{$order->method}}</p>
                                            @if($order->method != "Cash On Delivery")
                                                @if($order->method=="Stripe")
                                                   {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                                                @endif
                                                {{$order->method}} {{ $langg->lang296 }} <p id="ttn"> {{$order->txnid}}</p>
                                                <a id="tid" style="cursor: pointer;" class="mybtn2">{{ $langg->lang297 }}</a> 
                                                <form id="tform">
                                                    <input style="display: none; width: 100%;" type="text" id="tin" placeholder="{{ $langg->lang299 }}" required="" class="mb-3">
                                                    <input type="hidden" id="oid" value="{{$order->id}}">
                                                    <button style="display: none; padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tbtn" type="submit" class="mybtn1">{{ $langg->lang300 }}</button><a style="display: none; cursor: pointer;  padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tc"  class="mybtn1">{{ $langg->lang298 }}</a>    
                                                    {{-- Change 1 --}}
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <br>
                                <div class="table-responsive">
                                    <h5>{{ $langg->lang308 }}</h5>
                                    <table class="table table-bordered veiw-details-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ $langg->lang309 }}</th>
                                                <th width="35%">{{ $langg->lang310 }}</th>
                                                <th width="20%">{{ $langg->lang539 }}</th>
                                                <th>{{ $langg->lang314 }}</th>
                                                <th>{{ $langg->lang315 }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart->items as $product)
                                            <tr>
                                                <td>{{ $product['item']['id'] }}</td>
                                                <td>
                                                    <input type="hidden" value="{{ $product['license'] }}">
                                                    @if($product['item']['user_id'] != 0)
                                                    @php
                                                        $user = App\Models\User::find($product['item']['user_id']);
                                                    @endphp
                                                    @if(isset($user))
                                                        <a target="_blank"
                                                        href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                                    @else
                                                    <a target="_blank"
                                                        href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>

                                                    @endif
                                                    @else
                                                    <a target="_blank" class="d-block" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>

                                                    @endif
                                                    @if($product['item']['type'] != 'Physical')
	                                                    @if($order->payment_status == 'Completed')
		                                                    @if($product['item']['file'] != null)
			                                                    <a href="{{ route('user-order-download',['slug' => $order->order_number , 'id' => $product['item']['id']]) }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-download"></i> {{ $langg->lang316 }}
			                                                    </a>
			                                                    @else
			                                                    <a target="_blank" href="{{ $product['item']['link'] }}
			                                                        class="btn btn-sm btn-primary mt-1">
			                                                        <i class="fa fa-download"></i> {{ $langg->lang316 }}
			                                                    </a>
		                                                    @endif
		                                                    @if($product['license'] != '')
		                                                        <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-info product-btn mt-1" id="license"><i class="fa fa-eye"></i> {{ $langg->lang317 }}</a>
		                                                    @endif
	                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <b>{{ $langg->lang311 }}</b>: {{$product['qty']}} <br>
                                                    @if(!empty($product['size']))
                                                        <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                                                    @endif
                                                    @if(!empty($product['color']))
	                                                    <div class="d-flex mt-2">
	                                                       <b>{{ $langg->lang313 }}</b>:  <span id="color-bar" style="border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}};"></span>
	                                                    </div>
                                                    @endif
                                                    @if(!empty($product['keys']))
                                                        @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
                                                            <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{$order->currency_sign}}{{round($product['item_price'] * $order->currency_value,2)}}</td>
                                                <td>{{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row col-lg-12">
                                    <form id="" action="{{route('cancel-order')}}" method="POST" class="checkoutform col-lg-8">
                                        {{ csrf_field() }}
                                        @if(!empty($order->order_cancellation_detail)) 
                                           @php $order_cancellation_detail = json_decode($order->order_cancellation_detail);  @endphp
                                        @else 
                                           @php $order_cancellation_detail = '';  @endphp
                                        @endif
                                        <div class="checkout-area">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-step1" role="tabpanel" aria-labelledby="pills-step1-tab">
                                                    <div class="content-box">
                                                        <div class="content">
                                                            <div class="personal-info">
                                                                <h5 class="title">Cancel Order</h5>
                                                                <input type="hidden" id="order_id" class="form-control" name="order_id"  value="{{$order->id}}">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                    	<select name="cancellation_question" id="cancellation_question" class="form-control" required="">
                                                                    		<option value="">--Why you want to cancel order?*--</option>
                                                                    		<option value="The delivery is delayed" @if(isset($order_cancellation_detail->cancellation_question) && $order_cancellation_detail->cancellation_question== 'The delivery is delayed') selected @endif>The delivery is delayed</option>
                                                                    		<option value="Order placed by mistake" @if(isset($order_cancellation_detail->cancellation_question) && $order_cancellation_detail->cancellation_question== 'Order placed by mistake') selected @endif>Order placed by mistake</option>
                                                                    		<option value="Expected delivery time is too long" @if(isset($order_cancellation_detail->cancellation_question) && $order_cancellation_detail->cancellation_question== 'Expected delivery time is too long') selected @endif>Expected delivery time is too long</option>
                                                                    		<option value="I changed my mind" @if(isset($order_cancellation_detail->cancellation_question) && $order_cancellation_detail->cancellation_question== 'I changed my mind') selected @endif>I changed my mind</option>
                                                                    		<option value="My reason is not listed" @if(isset($order_cancellation_detail->cancellation_question) && $order_cancellation_detail->cancellation_question== 'My reason is not listed') selected @endif>My reason is not listed</option>
                                                                    	</select>
                                                                    </div>

                                                                </div>
                                                                <br>  	
                                                                @if(!empty($order->method !='Cash On Delivery'))
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <input type="text" id="bank_name" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="@if(!empty($order->order_cancellation_detail)) {{$order_cancellation_detail->bank_name}} @endif" required="">
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <input type="text" id="account_holder_name" class="form-control" name="account_holder_name" placeholder="Enter Account Holder Name" value="@if(!empty($order->order_cancellation_detail)) {{$order_cancellation_detail->account_holder_name}} @endif" required="">
                                                                        </div>
                                                                        <br clear="all"> 
                                                                        <div class="col-lg-6">
                                                                            <br>
                                                                            <input type="text" id="account_number" class="form-control" name="account_number" placeholder="Enter Account No." value="@if(!empty($order->order_cancellation_detail)) {{$order_cancellation_detail->account_number}}    @endif" required="">
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <br>
                                                                            <input type="text" id="ifsc_code" class="form-control" name="ifsc_code" placeholder="Enter IFSC Code" value="@if(!empty($order->order_cancellation_detail)) {{$order_cancellation_detail->ifsc_code}}    @endif" required="">
                                                                        </div>  
                                                                    </div>
                                                                @endif    
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <textarea id="reason" class="form-control" name="reason" placeholder="Enter Reason."  style="min-height: 100px !important;" required="">@if(!empty($order->order_cancellation_detail && isset($order_cancellation_detail->reason))) {{$order_cancellation_detail->reason}}@endif</textarea>
                                                                    </div>
                                                                </div>
                                                                @if(empty($order->order_cancellation_detail)) 
	                                                                <div class="row">
	                                                                    <div class="col-lg-12 mt-3">
	                                                                        <div class="bottom-area">
	                                                                            <button type="submit" name="submit" value="submit" id="final-btn" class="mybtn1" style="background-color: red !important; border:red;">Cancel</button>
	                                                                        </div>
	                                                                    </div>
	                                                                </div>
	                                                            @endif    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header d-block text-center">

                <h4 class="modal-title d-inline-block">{{ $langg->lang319 }}</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <p class="text-center">{{ $langg->lang320 }} <span id="key"></span></p>

            </div>

            <div class="modal-footer justify-content-center">

                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $langg->lang321 }}</button>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">

    $('#example').dataTable({

        "ordering": false,

        'paging': false,

        'lengthChange': false,

        'searching': false,

        'ordering': false,

        'info': false,

        'autoWidth': false,

        'responsive': true

    });

</script>

<script>

    $(document).on("click", "#tid", function (e) {

        $(this).hide();

        $("#tc").show();

        $("#tin").show();

        $("#tbtn").show();

    });

    $(document).on("click", "#tc", function (e) {

        $(this).hide();

        $("#tid").show();

        $("#tin").hide();

        $("#tbtn").hide();

    });

    $(document).on("submit", "#tform", function (e) {

        var oid = $("#oid").val();

        var tin = $("#tin").val();

        $.ajax({

            type: "GET",

            url: "{{URL::to('user/json/trans')}}",

            data: {

                id: oid,

                tin: tin

            },

            success: function (data) {

                $("#ttn").html(data);

                $("#tin").val("");

                $("#tid").show();

                $("#tin").hide();

                $("#tbtn").hide();

                $("#tc").hide();

            }

        });

        return false;

    });

</script>

<script type="text/javascript">

    $(document).on('click', '#license', function (e) {

        var id = $(this).parent().find('input[type=hidden]').val();

        $('#key').html(id);

    });

</script>

@endsection
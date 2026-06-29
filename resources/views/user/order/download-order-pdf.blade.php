<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Ecomerce">
    <meta name="author"   content="Ecomerce">
    <title>Rat Cart</title>
    <!-- favicon -->
     <!-- stylesheet -->
    <link rel="stylesheet" href="http://Ecomerce.knovatik.com/assets/front/css/all.css">
    <!--Updated CSS-->
    <link rel="stylesheet" href="http://Ecomerce.knovatik.com/assets/front/css/styles.php?color=0f78f2&amp;amp;header_color=ffffff&amp;amp;footer_color=143250&amp;amp;copyright_color=02020c&amp;amp;menu_color=ff5500&amp;amp;menu_hover_color=02020c">
    <style type="text/css">
            .logo-header .search-box .categori-container .categoris option {
                background: none !important; 
            }
            .verify-btn{
                height: 48px;
                text-align: center;
                border: 0px;
                color: #fff;
                font-weight: 700;
                text-transform: uppercase;
                margin-top: 20px;
                -o-transition: all 0.3s ease-in;
                transition: all 0.3s ease-in;
                cursor: pointer;
                margin: 0;
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
                border-radius: 0;
                box-sizing: border-box;
                -webkit-writing-mode: horizontal-tb !important;
                text-rendering: auto;
                letter-spacing: normal;
                word-spacing: normal;
                text-indent: 0px;
                text-shadow: none;
                display: inline-block;
                align-items: flex-start;
                font: 400 13.3333px Arial;
                padding: 17px 6px;
            }
    </style>
</head>
<body>
    <section class="user-dashbord">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="user-profile-details">
                    <div class="order-details">
                        
                        <div class="col-lg-6">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
                        </div>
                        <div class="view-order-page">
                            <div class="edit-account-info-div">
                                <div class="form-group row">
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
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
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
                                                    </td>
                                                    <td>    
                                                        <div class="col-md-6">
                                                            <h5>{{ $langg->lang305 }}</h5>
                                                            @if($order->shipping == "shipto")
                                                                <p>{{ $langg->lang306 }}</p>
                                                                @else<p>{{ $langg->lang307 }}</p>@endif
                                                                @if($order->shipping_cost != 0)
                                                                    @php $price = round(($order->shipping_cost / $order->currency_value),2); @endphp
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
                                                    </td>    
                                                </tr>    
                                            </tbody>    
                                        </table>    
                                    </div>
                                </div>
                                <div class="billing-add-area">
                                    <div class="row">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
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
                                                    </td>
                                                    <td>
                                                        <div class="col-md-6">
                                                            <h5>{{ $langg->lang292 }}</h5>
                                                            <p>{{ $langg->lang798 }}{!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
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
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>     
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
                                                <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
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
                                                            <a target="_blank" href="{{ $product['item']['link'] }} class="btn btn-sm btn-primary mt-1"><i class="fa fa-download"></i> {{ $langg->lang316 }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="http://Ecomerce.knovatik.com/assets/front/js/jquery.js"></script>
<script src="http://Ecomerce.knovatik.com/assets/front/js/vue.js"></script>
<script src="http://Ecomerce.knovatik.com/assets/front/jquery-ui/jquery-ui.min.js"></script>
<!-- popper -->
<script src="http://Ecomerce.knovatik.com/assets/front/js/popper.min.js"></script>
<!-- bootstrap -->
<script src="http://Ecomerce.knovatik.com/assets/front/js/bootstrap.min.js"></script>
<!-- plugin js-->
<script src="http://Ecomerce.knovatik.com/assets/front/js/plugin.js"></script>
<script src="http://Ecomerce.knovatik.com/assets/front/js/xzoom.min.js"></script>
<script src="http://Ecomerce.knovatik.com/assets/front/js/jquery.hammer.min.js"></script>
<script src="http://Ecomerce.knovatik.com/assets/front/js/setup.js"></script>
<script src="http://Ecomerce.knovatik.com/assets/front/js/toastr.js"></script>
<!-- main -->
<script src="http://Ecomerce.knovatik.com/assets/front/js/main.js"></script>
<!-- custom -->
<script src="http://Ecomerce.knovatik.com/assets/front/js/custom.js"></script>
</body>
</html>
    
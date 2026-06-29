<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecomerce</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100;600&display=swap" rel="stylesheet">
</head>

<body style="margin:0; padding:0">
    <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td align="center">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="700px">
                        <tbody>
                            <tr>
                                <td align="center" style="font-family: 'Montserrat', sans-serif;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style=" width:100%">
                                        <tbody>
                                            <tr>
                                                <td style="padding:10px 0; text-align: left;"><img src="http://Ecomerce.com/assets/images/245x53.png" alt="">
                                                </td>
                                                <td style="padding:10px 0; text-align: center;"><h3>Order Invoice</h3></td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #000;">
                                                <td style="padding:10px 0; border-bottom: 1px solid #000;"></td>
                                                <td width="300px" style="border-bottom: 1px solid #000;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" style="font-family: 'Montserrat', sans-serif;" cellpadding="0" cellspacing="0" width="700px">
                        <tbody>
                            <tr>
                                <td style="padding:10px 0; width: 208px !important;">
                                    <h5 style="margin-bottom: 5px;">Order No.: {{$order->order_number}}</h5>
                                    <p style="font-size:13px ; "><strong>Order Date:</strong> {{date('d-M-Y',strtotime($order->created_at))}}</p>
                                    <p style="font-size:13px ; "><strong>Order status:</strong> {{$order->status}}</p>
                                    <p style="font-size:13px ; "><strong>Payment status:</strong> @if($order->method != "Cash On Delivery") $langg->lang800 @else Pending @endif</p>
                                    <p style="font-size:13px ; ">&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                    <p style="font-size:13px ; ">&nbsp;</p>
                                </td>
                                <td style="padding:10px 0;">
                                    <h5 style="margin-bottom: 5px;">Shipping Address<br> &nbsp;</h5>
                                    <p style="font-size:13px ;margin:0; margin-right:20px; ">Name:&nbsp;{{$order->shipping_name}}<br>Email:&nbsp;{{$order->shipping_email}}<br>Mobile:&nbsp;{{$order->shipping_phone}} <br>Address:&nbsp;{{$order->shipping_address}}, {{$order->shipping_zip}} <br> &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;</p>
                                </td>
                                <td style="padding:10px 0;">
                                    <h5 style="margin-bottom: 5px;">Billing Address<br> &nbsp;</h5>
                                    <p style="font-size:13px ;margin:0; margin-right:20px; ">Name:&nbsp;{{$order->customer_name}}<br>Email:&nbsp;{{$order->customer_email}}<br>Mobile:&nbsp;{{$order->customer_phone}} <br>Address:&nbsp;{{$order->customer_address}}, {{$order->customer_zip}} <br> &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" style="font-family: 'Montserrat', sans-serif; margin-top: -53px;"  cellpadding="0" cellspacing="0" width="700px">
                        <thead>
                            <tr align="left">
                            	<th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 5%;">#</th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 20%;">Name</th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 30%;">Retailer</th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 19%;">GSTIN No.</th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 17%;">Detail</th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 5%;">Price <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 5%;">Total <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        	@php  $i = 1;  $tot_amount  = 0; @endphp
                        	@foreach($cart as $product)
                        	    @php $vendor = App\Models\User::detail($product->user_id); @endphp
	                            <tr>
	                            	<td style="padding:10px 0; width: 5%;">@php echo $i; $i++;  @endphp</td>
	                            	<td style="padding:10px 0; width: 20%;">{{ $product->name }}</td>
	                            	<td style="padding:10px 0; width: 30%;">@if(!empty($vendor)) {{$vendor->name}} @else {{ App\Models\Admin::detail()->shop_name }} @endif()</td>
	                            	<td style="padding:10px 0; width: 10%;">@if(!empty($vendor)) {{$vendor->gstin}} @else {{ App\Models\Admin::detail()->gstin }} @endif()</td>
	                            	<td style="padding:10px 0; width: 10%;">
	                            		<b>{{ $langg->lang311 }}</b>: {{$product->cart_qty}} <br>
                                        @if(!empty($product->cart_size))
                                            <b>{{ $langg->lang312 }}</b>: {{ $product->cart_size}} <br>
                                        @endif
                                        @if(!empty($product->cart_size))
                                            <b>{{ $langg->lang313 }}</b>:  <span style="background-color: {{$product->cart_color}};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        @endif
                                        @if(!empty($product->keys))
                                            @foreach( array_combine(explode(',', $product->keys), explode(',', $product->values))  as $key => $value)
                                                <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }}<br>
                                            @endforeach
                                        @endif
	                            	</td>
	                            	<td style="padding:10px 0; width: 5%; text-align: center;">{{round($product->cart_price)}}</td>
	                            	<td style="padding:10px 0; width: 5%; text-align: center;">
	                            		@php
                                            echo $amount  = round($product->cart_price * $product->cart_qty,2);
                                            $tot_amount   = $tot_amount + $amount;
                                        @endphp
	                            	</td>
	                            </tr>
	                        @endforeach()    
                        </tbody>
                        <thead>
                            <tr align="left">
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 5%;"></th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 20%;"></th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 30%;"></th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 19%;"></th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 17%;"></th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 5%;">Total</th>
                                <th scope="col" style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000 ; padding:5px; width: 5%;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>  @php echo $tot_amount; @endphp </th>
                            </tr>
                        </thead>
                    </table>
                    <table align="center" border="0" style="font-family: 'Montserrat', sans-serif;" cellpadding="0" cellspacing="0" width="700px">
                        <tbody>
                            <tr style="text-align: right;">
                                <td style="padding:0px 0; ">
                                	@if(!empty($order->coupon_discount))
                                       <h4 style="margin-top: 3px !important;"><strong style="margin-right: 20px;"> Discount:</strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> -{{ $order->coupon_discount }}</h4>
                                	@endif()
                                	@if(!empty($order->shipping_cost))
                                       <h4 style="margin-top: -22px !important;"><strong style="margin-right: 20px;"> Shipping cost:</strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ $order->shipping_cost }}</h4>
                                	@endif()
                                	@if(!empty($order->packing_cost))
                                       <h4 style="margin-top: -22px !important;"><strong style="margin-right: 20px;"> Packing cost:</strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ $order->packing_cost }}</h4>
                                	@endif()
                                    <h4 style="margin-top: -22px !important;"><strong style="margin-right: 20px;"> Grand Total:</strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ $order->pay_amount }}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" style="font-family: 'Montserrat', sans-serif; margin-top: 0px;" cellpadding="0" cellspacing="0" width="700px">
                        <tbody>
                            <tr>
                                <td style="padding:10px 0; border-bottom:1px solid #000;">
                                    <p style="  font-size: 11px; font-style: italic;"><strong> Returns Policy:</strong> At Ecomerce we try to deliver perfectly each and every time. But in the off-chance that you need to return the item, please do so with the <strong>original Brand box/price tag, </strong>Original packing and invoice without which it will be really difficult for us to act on your request. Please help us in helping you. Terms and conditions apply.</p>
                                    <p style="  font-size: 11px; font-style: italic;">The goods sold as are intended for end user consumption and not for re-sale.</p>
                                    <p style="  font-size: 11px; font-style: italic;">Regd. office: SYNHYPER SHOP ONLINE PRIVATE LIMITED ,92 KARRAHI ROAD BARRA KANPUR Kanpur UP 208027 IN</p>
                                    <h5>Contact Ecomerce: Ecomerceinfo@gmail.com</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
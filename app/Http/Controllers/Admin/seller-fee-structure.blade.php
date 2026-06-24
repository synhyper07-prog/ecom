@extends('layouts.vendor-front') 
@section('content')
<style type="text/css">
    .wrapper{
        white-space: nowrap; 
        text-align: center;
    }
</style>
<h2 class="Heading-3 text-center border-bottom">Fee Structure</h2>
<section class="main py-5">
    <h4 class="text-center mb-3"><img src="{{asset('assets/vendor_template/images/cash.png')}}" alt=""> The lowest cost of doing business in the industry</h4>
    <div class="container">
        <p>With the most competitive rate card in the industry, transparent delivery charges based on the weight and dimensions of your products and a small fixed fee, selling on Ratcart is highly cost-efficient.</p>
    </div>
    <hr>
    <div class="container text-center">
        <h3 class="my-4">RATCART'S MARKETPLACE FEE STRUCTURE</h3>
        <div class="feeBox">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{asset('assets/vendor_template/images/price-tag.png')}}" alt="">
                    <h5>Commission fee</h5>
                    <p>Percentage of Order item value (depends on category & sub-category)</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/vendor_template/images/trolley.png')}}" alt="">
                    <h5>Shipping fee</h5>
                    <p>Calculated on the basis of product weight and shipping location</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/vendor_template/images/dollar.png')}}" alt="">
                    <h5>Collection fee</h5>
                    <p>Payment gateway or cash collection charges for every sale</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt="">
                    <h5>Fixed fee</h5>
                    <p>A small fee that Ratcart charges on all transactions</p>
                </div>
            </div>
        </div>
        {{-- <div class="feeBox bg-white">
            <div class="row">
                <div class="col-md-3">
                    <h5>Settlement Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=</h5>
                    <p>credited to your bank account within 7-15 business days of dispatch</p>
                </div>
                <div class="col-md-3">
                    <h5>Order Item Value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</h5>
                    <p>Selling price & Shipping charge paid by customer and excludes discount offered by Seller</p>
                </div>
                <div class="col-md-3">
                    <h5>Marketplace Fee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</h5>
                    <p>Includes shipping fee, fixed fee and selling commission</p>
                </div>
                <div class="col-md-3">
                    <h5>GST</h5>
                    <p>18% of Marketplace Fee</p>
                </div>
            </div>
        </div> --}}
    </div>
    <hr>
    <h4 class="text-center mb-3">Delhivery Commercials For -- EXPRESS </h4>
    <div class="container">
        {{-- <p>To ensure ease of selling and the best possible customer experience, we mandate delivery to all customers via our logistics partners and deduct the shipping cost from the selling price before making a payment to you. Shipping fee is calculated on actual weight or volumetric weight, whichever is higher. This is to account for items which are lightweight but occupy a lot of shipping space.
        </p> --}}
        <p class="text-center"><i>SHIPMENT DIMENSIONS CALCULATION = Length (cm) X Breadth (cm) X Height (cm)/5000</i></p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="wrapper">{{ __('Within-city') }}</th>
                        <th class="wrapper">{{ __('Regional (Single Connection &<500Kms)') }}</th>
                        <th class="wrapper">{{ __('Metro-Metro') }}</th>
                        <th class="wrapper">{{ __('Rest of India') }}</th>
                        <th class="wrapper">{{ __('North East / J&K / Himachal Pradesh / Andman') }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="wrapper">{{ __('Zone A') }}</th>
                        <th class="wrapper">{{ __('Zone B') }}</th>
                        <th class="wrapper">{{ __('Zone C') }}</th>
                        <th class="wrapper">{{ __('Zone D') }}</th>
                        <th class="wrapper">{{ __('Zone E') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $value->weight_slab }}</td>
                            <td class="wrapper">{{ $currency->sign }} {{ $value->zone_a }}</td>
                            <td class="wrapper">{{ $currency->sign }} {{ $value->zone_b }}</td>
                            <td class="wrapper">{{ $currency->sign }} {{ $value->zone_c }}</td>
                            <td class="wrapper">{{ $currency->sign }} {{ $value->zone_d }}</td>
                            <td class="wrapper">{{ $currency->sign }} {{ $value->zone_e }}</td>
                        </tr>
                    @endforeach     
                </tbody>
            </table>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Cash On Delivery Charges</td>
                        <td>Rs. 50 or 2% of the value, Whichever is higher</td>
                    </tr>
                    <tr>
                        <td>Volumetric Formula</td>
                        <td>L*B*H/5000 (in cms) -> See image on right to understand Volumetric Weight Calculation</td>
                    </tr>
                    <tr>
                        <td>Fuel Surcharge (FSC)</td>
                        <td>25% on Freight Charges</td>
                    </tr>
                    <tr>
                        <td>Covid Fuel Surcharge (FSC)</td>
                        <td>₹2.2/AWB</td>
                    </tr>
                    <tr>
                        <td>Covid Fee</td>
                        <td>₹1.5/AWB</td>
                    </tr>
                    <tr>
                        <td><strong>GST / Tax</strong></td>
                        <td><strong>Additional on above commercials, as per Govt norms</strong></td>
                    </tr>
                </tbody>
            </table>        
        </div>
        <div class="row">
            <div class="col-md-12">
                <ol>
                    <li>RTO = Return to Origin, in the case that the customer is not available to receive the courier, it is returned back to the shipper.</li>
                    <li>DTO = Deliver to Origin, in the case that the customer wants to return the product back to the shipper.</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Weight Measurement : Dead Weight or Volumetric, whichever is higher. For volumetric weight calculation, all sides are measured in cm.</p>
            </div>
        </div>
    </div>
</section>
@endsection

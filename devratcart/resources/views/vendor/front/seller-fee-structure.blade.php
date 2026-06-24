@extends('layouts.vendor-front') 
@section('content')
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
                    <p>Percentage of Order item value ( depends on category & sub-category</p>
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
        <div class="feeBox bg-white">
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
        </div>
    </div>
    <hr>
    <h4 class="text-center mb-3">SHIPPING FEES</h4>
    <div class="container">
        <p>To ensure ease of selling and the best possible customer experience, we mandate delivery to all customers via our logistics partners and deduct the shipping cost from the selling price before making a payment to you. Shipping fee is calculated on actual weight or volumetric weight, whichever is higher. This is to account for items which are lightweight but occupy a lot of shipping space.
        </p>
        <p><i>Volumetric Weight (kg) = Length (cm) X Breadth (cm) X Height (cm)/5000
        </i></p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Slab') }}</th>
                        <th>{{ __('LOCAL (INTRACITY)') }}</th>
                        <th>{{ __('ZONAL (INTRAZONE)') }}</th>
                        <th>{{ __('NATIONAL (INTERZONE)') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                        <tr>
                            <td>@php echo $key + 1;  @endphp</td>
                            <td>{{ $value->weight_slab }}</td>
                            <td>{{ $currency->sign }} {{ $value->local }}</td>
                            <td>{{ $currency->sign }} {{ $value->zonal }}</td>
                            <td>{{ $currency->sign }} {{ $value->national }}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <h5 class="mt-3">Note:</h5>
        <div class="row">
            <div class="col-md-6">
                <ol>
                    <li>Shipping rate for forward shipments is applicable for <a href="#0" target="_blank">Bronze Sellers</a> only.</li>
                    <li>There is 20% and 10% discount on the forward shipping fee for <a href="#0" target="_blank">Gold</a> and <a href="#0" target="_blank">Silver Sellers</a> respectively.</li>
                    <li>Mentioned rates are exclusive of all taxes.</li>
                </ol>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>Local (Intracity): Item shipped within a city.</li>
                    <li>Zonal (Intrazone): Item shipped within the borders of a zone (North, South, East, West).</li>
                    <li>National (Interzone): Item shipped across zones.</li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <h4 class="text-center mb-3">COLLECTION FEES</h4>
    <div class="container">
        <p>A small payment collection fee is charged to you for all prepaid and postpaid orders that you receive. The Collection fee will vary depending on the payment type chosen by the customer (Prepaid/Postpaid) . For a prepaid order - Based on Payment gateway, For a postpaid order - Based on cash collection charges. The collection fee will be calculated on the final selling price of a product. The final selling price is a sum of the amount paid by the Customer including shipping charges, if any (Price of product + Shipping charges). This will remain the same for all sellers irrespective of the category and tier.</p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="table-data">Selling Price</th>
                        <th class="table-data">Prepaid</th>
                        <th class="table-data">Postpaid</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-data">0-750</td>
                        <td class="table-data">2%</td>
                        <td class="table-data">₹15</td>
                    </tr>
                    <tr>
                        <td class="table-data">&gt;750</td>
                        <td class="table-data">2%</td>
                        <td class="table-data">2%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <h4 class="text-center mb-3">FIXED FEES</h4>
    <div class="container">
        <p>Fixed Fee is a small amount charged for every successful sale transaction. A successful sale transaction is an order which has been successfully delivered to the customer and has not been returned. In case of customer or courier returns, this fee will not be charged. The Fixed fee will vary based on the order item value irrespective of category and seller tier.</p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="table-data">Order Item Value</th>
                        <th class="table-data">Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-data">0-500</td>
                        <td class="table-data">₹12</td>
                    </tr>
                    <tr>
                        <td class="table-data">500-1000</td>
                        <td class="table-data">₹20</td>
                    </tr>
                    <tr>
                        <td class="table-data">&gt;1000</td>
                        <td class="table-data">₹35</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="container text-center">
        <h3 class="my-4">FULFILMENT TYPES</h3>
        <div class="feeBox feeBox2 bg-white">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('assets/vendor_template/images/price-tag.png')}}" alt="">
                    <h5>Seller Fulfilment</h5>
                    <p>Under seller fulfillment, you are responsible for processing and managing your orders and inventory. Once you have packed your orders and marked RTD, an E-kart agent will collect </p>
                    <a href="#0">Know More</a>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/vendor_template/images/trolley.png')}}" alt="">
                    <h5>Smart Fulfilment</h5>
                    <p>Smart Fulfillment is a program wherein you get help from Ratcart for systematically arranging your warehouse, easily maintaining your inventory and getting it smoothly delivered to</p>
                    <a href="#0">Know More</a>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/vendor_template/images/dollar.png')}}" alt="">
                    <h5>Ratcart Fulfilment</h5>
                    <p>At Ratcart, we help you have maximum returns with minimum investment. That’s why the Ratcart Fulfilment service offers you the use of our state-of-the-art fulfillment centers at </p>
                    <a href="#0">Know More</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.vendor-front') 
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<!--Latest Bootstrap css  4.5.0 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
<section class="priceCalculator">
<div class="container">
    <div class="sc-pZdvY gZiCe">
        <div class="sc-oTzgz nnuJi">PRICING CALCULATOR</div>
        <div class="sc-pbvYO hMYTdE">Please, fill in the details to get <strong>Approximate calculation</strong> of your sale on Flipkart</div>
        <div>
            <div class="sc-pjumZ grWZmK">
                <div class="sc-prrfo elwNsP">
                    <div class="sc-qQKeD bSwWwA">Seller Type<a class="know-more" href="#">Know more</a></div>
                    <div class="sc-qYGWS jnzTeZ">
                        <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8 selected"><span class="sc-pBxWu gglDmq"><svg viewBox="0 0 16 16" width="20px"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Group" transform="translate(1.928571, 0.714286)" fill="#EEC94E" fill-rule="nonzero"><path d="M0.492277992,8.86564908 C0.492277992,10.6031268 2.31813463,12.3300936 6.07142792,13.9751791 C9.8247223,12.3300938 11.6505792,10.6031269 11.6505792,8.86564908 L11.6505792,1.35237905 C9.76067532,0.827573426 7.87397551,0.565437844 5.98938224,0.565437844 C4.11076853,0.565437844 2.27886901,0.825902497 0.492277992,1.34698115 L0.492277992,8.86564908 Z M0,0.982343499 C1.943319,0.376958563 3.93977975,0.0742660942 5.98938224,0.0742660942 C8.03898473,0.0742660942 10.090143,0.376958563 12.1428571,0.982343499 L12.1428571,8.86564908 C12.1428571,10.8887313 10.1190476,12.7704559 6.07142857,14.5108228 C2.02380952,12.7704559 0,10.8887313 0,8.86564908 L0,0.982343499 Z M1.00227117,1.76005997 C1.00227117,4.60206258 1.00227117,6.88525529 1.00227117,8.6096381 C1.00227117,10.29875 2.69199031,11.929317 6.07142857,13.501339 C9.45086684,11.929317 11.140586,10.29875 11.140586,8.6096381 C11.140586,6.75490103 11.140586,4.47170832 11.140586,1.76005997 C9.42673382,1.25461195 7.71418064,1.00188795 6.00292644,1.00188795 C4.29167225,1.00188795 2.62478716,1.25461195 1.00227117,1.76005997 Z M6.10233318,7.55685757 L6.10233318,6.46666742 L8.92463218,6.46666742 L8.92463218,9.04428301 C8.65036351,9.30910785 8.25297481,9.54229734 7.73245415,9.74385847 C7.2119335,9.9454196 6.68478523,10.0461987 6.15099351,10.0461987 C5.47269464,10.0461987 4.88140385,9.90422524 4.37710339,9.62027416 C3.87280293,9.33632308 3.49384598,8.93026441 3.24022119,8.40208597 C2.9865964,7.87390754 2.8597859,7.29939337 2.8597859,6.67852624 C2.8597859,6.00469414 3.0013418,5.40590472 3.28445785,4.88214003 C3.5675739,4.35837534 3.98191982,3.95673036 4.52750804,3.67719302 C4.94333473,3.46239065 5.46089849,3.35499107 6.08021485,3.35499107 C6.88532611,3.35499107 7.51421769,3.52344657 7.96690846,3.86036262 C8.41959922,4.19727867 8.710821,4.66292204 8.84058252,5.25730668 L7.54002468,5.50006158 C7.44860179,5.18227176 7.2768178,4.93142755 7.02466757,4.74752141 C6.77251734,4.56361527 6.45770292,4.47166358 6.08021485,4.47166358 C5.5080845,4.47166358 5.05318872,4.65262451 4.71551385,5.01455179 C4.37783898,5.37647908 4.20900407,5.91347695 4.20900407,6.62556153 C4.20900407,7.39355358 4.38005079,7.96953897 4.72214935,8.35353499 C5.0642479,8.73753102 5.51250826,8.92952615 6.06694385,8.92952615 C6.34121252,8.92952615 6.61621435,8.87582636 6.89195759,8.76842517 C7.16770082,8.66102399 7.40436459,8.53082039 7.601956,8.37781048 L7.601956,7.55685757 L6.10233318,7.55685757 Z" id="Combined-Shape"></path></g></g></svg></span>Gold Seller</button>
                        <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8"><span class="sc-pBxWu gglDmq"><svg viewBox="0 0 16 16" width="20px"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M2.55212355,9.54110117 C2.55212355,11.2432314 4.33501886,12.9350645 7.99999936,14.5466822 C11.6649809,12.9350647 13.4478764,11.2432315 13.4478764,9.54110117 L13.4478764,2.18068225 C11.6024409,1.66655336 9.76013407,1.4097507 7.91988417,1.4097507 C6.08547313,1.4097507 4.29667714,1.66491643 2.55212355,2.17539417 L2.55212355,9.54110117 Z M2.07142857,1.81817477 C3.96902242,1.22510587 5.91850762,0.928571429 7.91988417,0.928571429 C9.92126072,0.928571429 11.9241565,1.22510587 13.9285714,1.81817477 L13.9285714,9.54110117 C13.9285714,11.5230255 11.952381,13.366468 8,15.0714286 C4.04761905,13.366468 2.07142857,11.5230255 2.07142857,9.54110117 L2.07142857,1.81817477 Z M3.45813906,3.02353244 C4.91188007,2.56918413 6.40537488,2.34200997 7.9386235,2.34200997 C9.47187212,2.34200997 11.0062846,2.56918413 12.5418609,3.02353244 C12.5418609,5.461039 12.5418609,7.51340586 12.5418609,9.18063302 C12.5418609,10.6989794 11.0279073,12.1646995 8,13.5777935 C4.97209271,12.1646995 3.45813906,10.6989794 3.45813906,9.18063302 C3.45813906,7.63058159 3.45813906,5.57821473 3.45813906,3.02353244 Z M5.43629344,8.4776198 C5.51815717,9.12786532 5.76939037,9.62281103 6.19000058,9.9624718 C6.61061079,10.3021326 7.2132882,10.4719604 7.99805087,10.4719604 C8.53722235,10.4719604 8.98746613,10.4012539 9.3487957,10.2598387 C9.71012528,10.1184235 9.98958693,9.90233906 10.187189,9.61157887 C10.3847912,9.32081868 10.4835907,9.00891697 10.4835907,8.67586439 C10.4835907,8.30844924 10.4010225,7.99985158 10.2358836,7.75006214 C10.0707447,7.50027271 9.84209426,7.30335171 9.54992542,7.15929326 C9.25775658,7.0152348 8.8068071,6.87580416 8.19706343,6.74099717 C7.58731977,6.60619017 7.20341286,6.47667166 7.04533117,6.35243776 C6.92112412,6.25463661 6.85902153,6.13701266 6.85902153,5.99956239 C6.85902153,5.84889574 6.92535839,5.72862856 7.05803409,5.63875723 C7.26410487,5.49866368 7.54921221,5.42861796 7.91336468,5.42861796 C8.26622559,5.42861796 8.53086731,5.49403802 8.70729777,5.62488011 C8.88372822,5.75572219 8.99875916,5.97048502 9.05239402,6.26917503 L10.3057497,6.21763144 C10.2859895,5.68369 10.0792161,5.25680758 9.68542333,4.93697137 C9.29163055,4.61713516 8.70518451,4.45721945 7.92606761,4.45721945 C7.44899965,4.45721945 7.04180426,4.52462194 6.70446923,4.65942894 C6.36713419,4.79423594 6.10884387,4.99049612 5.92959053,5.24821538 C5.75033718,5.50593464 5.66071186,5.78281349 5.66071186,6.07886022 C5.66071186,6.53878998 5.85125389,6.92866711 6.23234368,7.24850332 C6.50334086,7.47582493 6.97475598,7.66745945 7.64660316,7.82341264 C8.16883731,7.94500327 8.50334444,8.02958678 8.65013458,8.07716572 C8.86467402,8.14853413 9.01499052,8.23245684 9.10108858,8.32893636 C9.18718664,8.42541587 9.23023503,8.54237901 9.23023503,8.67982929 C9.23023503,8.89393452 9.1279069,9.08094338 8.92324757,9.24086148 C8.71858824,9.40077959 8.41442669,9.48073744 8.0107538,9.48073744 C7.62966401,9.48073744 7.32691389,9.39086746 7.10249435,9.21112479 C6.87807481,9.03138213 6.72916973,8.74987762 6.65577466,8.36660283 L5.43629344,8.4776198 Z" id="Combined-Shape" fill="#B6B6BB" fill-rule="nonzero"></path><path d="M2.3523166,9.58780121 C2.3523166,11.3415111 4.18891357,13.084612 7.96428506,14.7450665 C11.7396576,13.0846122 13.5762548,11.3415112 13.5762548,9.58780121 L13.5762548,2.00433929 C11.6752339,1.47463074 9.77743587,1.21004618 7.88175676,1.21004618 C5.99209237,1.21004618 4.14941698,1.4729442 2.3523166,1.99889097 L2.3523166,9.58780121 Z M1.85714286,1.63084673 C3.81189315,1.01980605 5.82009778,0.714285714 7.88175676,0.714285714 C9.94341573,0.714285714 12.0066397,1.01980605 14.0714286,1.63084673 L14.0714286,9.58780121 C14.0714286,11.6297839 12.0357143,13.5290882 7.96428571,15.2857143 C3.89285714,13.5290882 1.85714286,11.6297839 1.85714286,9.58780121 L1.85714286,1.63084673 Z M2.87525781,2.4266356 C4.50413386,1.91746577 6.17755295,1.66288085 7.89551507,1.66288085 C9.61347718,1.66288085 11.3327434,1.91746577 13.0533136,2.4266356 C13.0533136,5.15825092 13.0533136,7.4582557 13.0533136,9.32664995 C13.0533136,11.0281995 11.356971,12.670773 7.96428571,14.2543704 C4.57160044,12.670773 2.87525781,11.0281995 2.87525781,9.32664995 C2.87525781,7.58956981 2.87525781,5.28956503 2.87525781,2.4266356 Z M5.0757722,8.54819434 C5.16813309,9.28067293 5.45158122,9.83821178 5.9261251,10.2208276 C6.40066898,10.6034435 7.08062601,10.7947485 7.96601661,10.7947485 C8.57432453,10.7947485 9.0823018,10.7151001 9.48996366,10.5558009 C9.89762551,10.3965017 10.2129217,10.1530902 10.4358618,9.82555915 C10.6588019,9.49802808 10.7702703,9.14668183 10.7702703,8.77150987 C10.7702703,8.35762969 10.6771146,8.01000534 10.4908004,7.72862637 C10.3044861,7.4472474 10.0465165,7.22542286 9.71688367,7.0631461 C9.38725084,6.90086934 8.87847737,6.74380566 8.19054799,6.59195034 C7.50261861,6.44009503 7.06948439,6.29419701 6.89113232,6.15425191 C6.75099856,6.04408237 6.68093273,5.91158315 6.68093273,5.75675028 C6.68093273,5.58702963 6.75577578,5.4515529 6.90546411,5.35031602 C7.13795877,5.19250559 7.45962462,5.11360156 7.87047134,5.11360156 C8.26857862,5.11360156 8.5671546,5.18729495 8.76620824,5.33468393 C8.96526188,5.48207292 9.09504291,5.72399565 9.15555521,6.06045939 L10.5696252,6.00239736 C10.5473312,5.4009312 10.3140438,4.92006324 9.8697561,4.55977906 C9.42546838,4.19949488 8.763824,4.01935549 7.88480313,4.01935549 C7.34656208,4.01935549 6.88715317,4.09528201 6.50656261,4.24713733 C6.12597205,4.39899264 5.83456189,4.6200728 5.6323234,4.91038444 C5.4300849,5.20069607 5.32896717,5.5125903 5.32896717,5.84607649 C5.32896717,6.3641711 5.54394187,6.80335391 5.97389774,7.16363809 C6.27964413,7.41970784 6.81150748,7.63557735 7.56950374,7.81125311 C8.15870251,7.94822065 8.53610255,8.04350099 8.70171518,8.09709698 C8.94376441,8.17749097 9.11335557,8.27202694 9.21049374,8.3807077 C9.30763192,8.48938847 9.35620028,8.62114331 9.35620028,8.77597618 C9.35620028,9.01715815 9.2407509,9.22781703 9.00984868,9.40795912 C8.77894645,9.58810121 8.43578313,9.6781709 7.9803484,9.6781709 C7.55039253,9.6781709 7.20882161,9.57693554 6.95562538,9.37446179 C6.70242915,9.17198803 6.5344304,8.85488316 6.45162408,8.42313765 L5.0757722,8.54819434 Z" id="Combined-Shape" fill="#B6B6BB" fill-rule="nonzero"></path></g></svg></span>Silver Seller</button>
                        <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8"><span class="sc-pBxWu gglDmq"><svg viewBox="0 0 16 16" width="20px"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M2.3523166,9.58780121 C2.3523166,11.3415111 4.18891357,13.084612 7.96428506,14.7450665 C11.7396576,13.0846122 13.5762548,11.3415112 13.5762548,9.58780121 L13.5762548,2.00433929 C11.6752339,1.47463074 9.77743587,1.21004618 7.88175676,1.21004618 C5.99209237,1.21004618 4.14941698,1.4729442 2.3523166,1.99889097 L2.3523166,9.58780121 Z M1.85714286,1.63084673 C3.81189315,1.01980605 5.82009778,0.714285714 7.88175676,0.714285714 C9.94341573,0.714285714 12.0066397,1.01980605 14.0714286,1.63084673 L14.0714286,9.58780121 C14.0714286,11.6297839 12.0357143,13.5290882 7.96428571,15.2857143 C3.89285714,13.5290882 1.85714286,11.6297839 1.85714286,9.58780121 L1.85714286,1.63084673 Z M2.86712622,2.41780354 C4.498605,1.90781518 6.17469799,1.65282099 7.89540518,1.65282099 C9.61611237,1.65282099 11.3381257,1.90781518 13.0614452,2.41780354 C13.0614452,5.15381013 13.0614452,7.45751234 13.0614452,9.32891017 C13.0614452,11.0331951 11.362392,12.6784091 7.96428571,14.2645523 C4.56617939,12.6784091 2.86712622,11.0331951 2.86712622,9.32891017 C2.86712622,7.58903754 2.86712622,5.28533533 2.86712622,2.41780354 Z M5.35686732,4.03541422 L5.35686732,10.7867277 L7.65860303,10.7867277 C8.52886951,10.7805873 9.07777494,10.7652366 9.30533579,10.7406751 C9.66820309,10.7007626 9.97340681,10.5940751 10.2209561,10.4206094 C10.4685054,10.2471437 10.6637743,10.0153478 10.8067686,9.72521489 C10.9497629,9.43508196 11.021259,9.13651049 11.021259,8.82949152 C11.021259,8.43957742 10.9105554,8.10032654 10.6891448,7.81172871 C10.4677343,7.52313087 10.1509989,7.31896632 9.73892929,7.19922892 C10.0310682,7.06721076 10.2624695,6.86918649 10.4331402,6.60515018 C10.6038108,6.34111386 10.6891448,6.05098528 10.6891448,5.73475574 C10.6891448,5.44308772 10.6199551,5.17982289 10.4815735,4.94495338 C10.3431919,4.71008387 10.1702175,4.52203757 9.96264509,4.38080884 C9.75507269,4.23958011 9.51982751,4.14670826 9.25690247,4.10219051 C8.99397744,4.05767276 8.59498316,4.03541422 8.05990765,4.03541422 L5.35686732,4.03541422 Z M6.72222558,5.15909804 L7.50638403,5.15909804 C8.14908967,5.15909804 8.53808988,5.1667734 8.67339633,5.18212435 C8.90095718,5.20975606 9.07239403,5.28881226 9.18771202,5.41929532 C9.30303002,5.54977839 9.36068815,5.71940382 9.36068815,5.92817673 C9.36068815,6.1461602 9.29380472,6.32192592 9.16003584,6.45547918 C9.02626697,6.58903243 8.84252971,6.6696237 8.60881857,6.69725541 C8.47966242,6.71260636 8.14908912,6.72028172 7.61708876,6.72028172 L6.72222558,6.72028172 L6.72222558,5.15909804 Z M6.72222558,7.84396554 L7.82466011,7.84396554 C8.44583972,7.84396554 8.84944666,7.87620205 9.03549303,7.94067603 C9.2215394,8.00515002 9.36376279,8.10799983 9.46216748,8.24922856 C9.56057217,8.39045729 9.60977378,8.56238533 9.60977378,8.76501785 C9.60977378,9.00449265 9.54596545,9.1956091 9.41834686,9.33837292 C9.29072828,9.48113674 9.12544163,9.57093844 8.92248196,9.60778072 C8.79025065,9.63541243 8.47812796,9.64922808 7.9861045,9.64922808 L6.72222558,9.64922808 L6.72222558,7.84396554 Z" id="Combined-Shape" fill="#F5A977" fill-rule="nonzero"></path></g></svg></span>Bronze Seller</button>
                    </div>
                </div>
                <div class="sc-pJVnX jOExFg">
                    <div class="sc-qQKeD bSwWwA">Fulfilment Type<a class="know-more" href="#">Know more</a></div>
                    <div class="sc-qYGWS jnzTeZ">
                        <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8">Flipkart Fulfilment</button>
                        <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8 selected">Smart Fulfilment</button>
                        <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8">Seller Fulfilment</button>
                    </div>
                </div>
            </div>
            <div class="sc-pkvvt bMZHNh"></div>
            <div class="sc-pRtcU iqDVFC">
                <div class="sc-pZQux hUtuZY">
                    <div class="sc-oTLFK hRSeLE">
                        <div class="sc-qXgLg kKFcHj">
                            <div class="sc-pzXPE lhhXeF">Product category</div>
                            <div class="typeHeadWrapper">
                                <div class="styles__TypeAheadBox-ykq4z9-0 OOjOX">
                                    <div class="styles__SimpleSearchContainer-sc-18h4eqq-0 styles__SimpleSearchContainerBig-sc-18h4eqq-1 kbvApT">
                                        <input type="text" placeholder="Search category.." class="styles__StyledInput-sc-6fhdqq-0 gEzlIS" value="book  in  Books"><i class="styles__StyledIcon-sc-18h4eqq-2 styles__TimesCircleBigStyledIcon-sc-18h4eqq-5 hfyoxL fa fa-times-circle"></i>
                                        <i
                                            class="styles__StyledIcon-sc-18h4eqq-2 styles__SearchBigStyledIcon-sc-18h4eqq-6 hOKuUz fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sc-pQQXS iWCqut">
                            <div class="sc-pZopv bjKdkd">Selling Price (Incl of Shipping charges)</div>
                            <div class="sc-pzLqt xYkXJ">
                                <div class="sc-oUbqx bhXLfl"><span style="margin-left: 15px; font-size: 15px;">₹</span>
                                    <input type="number" name="sellingPrice" class="styles__StyledInput-sc-6fhdqq-0 gEzlIS input-height" placeholder="" value="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sc-pciXn kKVZfa">Package Volume &amp; Weight</div>
                    <div class="sc-pjGMk jrwOpx">
                        <div class="sc-psedN fLDHlO">
                            <svg width="267px" viewBox="0 0 267 220">
                            <g id="Final" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Pricing" transform="translate(-157.000000, -2490.000000)">
                                    <g id="Stacked-Group">
                                        <g id="Stacked-Group-2" transform="translate(0.000000, 138.000000)">
                                            <g id="Pricing-Calculator" transform="translate(0.000000, 1921.000000)">
                                                <g id="Stacked-Group" transform="translate(125.000000, 158.000000)">
                                                    <g id="Group-11" transform="translate(0.000000, 239.000000)">
                                                        <g id="img_package" transform="translate(33.000000, 34.000000)">
                                                            <g id="Group-3">
                                                                <polygon id="Path-3-Copy" fill-opacity="0.056826" fill="#000000" points="0 134.020142 141.571957 217.472535 185.639057 219.2 265.6 171.80502 100.405819 70.4"></polygon>
                                                                <polygon id="Rectangle" fill="#E0B471" points="-1.89388897e-13 50.4 141.6 133.546705 141.6 217.6 0 137.064761"></polygon>
                                                                <polygon id="Rectangle" fill="#BF8B4B" transform="translate(185.600000, 149.200000) scale(-1, 1) translate(-185.600000, -149.200000) " points="141.6 80.8 229.6 133.732518 229.6 217.6 141.6 165.431714"></polygon>
                                                                <polygon id="Path-3" fill="#EECC8A" points="0 50.4 141.506531 133.6 229.6 80.8 87.4432384 0"></polygon>
                                                            </g>
                                                            <g id="Group-7" transform="translate(0.000000, 50.400000)">
                                                                <path d="M0,0 L141.6,83.6" id="Path-4" stroke="#DA2233" stroke-width="3" stroke-linejoin="round"></path>
                                                                <circle id="Oval" fill="#DA2233" cx="78" cy="46" r="10.8"></circle>
                                                                <text id="L" font-family="OpenSans-Bold, Open Sans" font-size="14.4" font-weight="bold" fill="#FFFFFF">
                                                                    <tspan x="74.4" y="50.2">L</tspan>
                                                                </text>
                                                            </g>
                                                            <g id="Group-6" transform="translate(131.200000, 134.000000)">
                                                                <path d="M10.4,83.6 L10.4,0" id="Path-7" stroke="#27AC70" stroke-width="3" stroke-linejoin="round"></path>
                                                                <circle id="Oval-Copy" fill="#27AC70" cx="10.8" cy="39.2" r="10.8"></circle>
                                                                <text id="H" font-family="OpenSans-Bold, Open Sans" font-size="14.4" font-weight="bold" fill="#FFFFFF">
                                                                    <tspan x="4.8" y="44.2">H</tspan>
                                                                </text>
                                                            </g>
                                                            <g id="Group-4" transform="translate(141.600000, 81.600000)">
                                                                <path d="M0,52.1682859 L88,0" id="Path-5" stroke="#347CFF" stroke-width="3" stroke-linejoin="round"></path>
                                                                <circle id="Oval-Copy-2" fill="#347CFF" cx="50.8" cy="22.9682859" r="10.8"></circle>
                                                                <text id="B" font-family="OpenSans-Bold, Open Sans" font-size="14.4" font-weight="bold" fill="#FFFFFF">
                                                                    <tspan x="45.6" y="27.9682859">B</tspan>
                                                                </text>
                                                            </g>
                                                            <g id="Group-5" transform="translate(111.200000, 54.400000)">
                                                                <circle id="Oval-Copy-3" fill="#4A4A4A" cx="10.8" cy="10.8" r="10.8"></circle>
                                                                <text id="W" font-family="OpenSans-Bold, Open Sans" font-size="14.4" font-weight="bold" fill="#FFFFFF">
                                                                    <tspan x="4" y="16.6">W</tspan>
                                                                </text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        </div>
                        <div class="sc-qQWDO dxrmGe">
                            <div class="sc-pzLqt jNjYIM">
                                <div class="sc-pQEyH dcFELj red">Length</div>
                                <div class="sc-oUbqx dqTtJZ">
                                    <input type="number" name="length" class="styles__StyledInput-sc-6fhdqq-0 gEzlIS input-height" placeholder="" value="10">
                                </div><span class="sc-pYBma ewstdt">cm</span></div>
                            <div class="sc-pzLqt jNjYIM">
                                <div class="sc-pQEyH dcFELj blue">Breadth</div>
                                <div class="sc-oUbqx dqTtJZ">
                                    <input type="number" name="breadth" class="styles__StyledInput-sc-6fhdqq-0 gEzlIS input-height" placeholder="" value="10">
                                </div><span class="sc-pYBma ewstdt"> cm</span></div>
                            <div class="sc-pzLqt jNjYIM">
                                <div class="sc-pQEyH dcFELj green">Height</div>
                                <div class="sc-oUbqx dqTtJZ">
                                    <input type="number" name="height" class="styles__StyledInput-sc-6fhdqq-0 gEzlIS input-height" placeholder="" value="10">
                                </div><span class="sc-pYBma ewstdt"> cm</span></div>
                            <div class="sc-pzLqt jNjYIM">
                                <div class="sc-pQEyH dcFELj black">Weight</div>
                                <div class="sc-oUbqx dqTtJZ">
                                    <input type="number" name="weight" class="styles__StyledInput-sc-6fhdqq-0 gEzlIS input-height" placeholder="" value="2">
                                </div><span class="sc-pYBma ewstdt"> kg</span></div>
                        </div>
                    </div>
                    <div class="sc-pbYdQ bvDgOc">
                        <div class="sc-qQKeD bSwWwA">Shipping Type</div>
                        <div class="sc-qYGWS jnzTeZ">
                            <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8 selected">Local</button>
                            <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8">Zonal</button>
                            <button class="BaseButton-sc-1ha84b-0 SecondaryBtn__SecondaryBtnDetails-sc-1ut574a-0 kQwhPo margin-8">National</button>
                        </div>
                    </div>
                </div>
                <div class="sc-pAkoP jUkCXP">
                    <div class="sc-pIhhe kIEkYy">
                        <div class="sc-pQfvp eqCZOB">
                            <div class="sc-pYcnE kSkqbf first-td">Selling Price</div>
                            <div class="sc-pYcnE kSkqbf second-td selling-price">₹200</div>
                        </div>
                        <hr class="sc-oUAoT gUkkcK">
                        <div class="sc-pQfvp eqCZOB">
                            <div class="sc-pYcnE kSkqbf first-td">Commission Fee</div>
                            <div class="sc-pYcnE kSkqbf second-td">-₹0</div>
                        </div>
                        <div class="sc-pQfvp eqCZOB">
                            <div class="sc-pYcnE kSkqbf first-td">Collection Fee</div>
                            <div class="sc-pYcnE kSkqbf second-td">-₹4</div>
                        </div>
                        <div class="sc-pQfvp eqCZOB">
                            <div class="sc-pYcnE kSkqbf first-td">Fixed Fee</div>
                            <div class="sc-pYcnE kSkqbf second-td">-₹13</div>
                        </div>
                        <div class="sc-pQfvp eqCZOB">
                            <div class="sc-pYcnE kSkqbf first-td">Shipping Fee</div>
                            <div class="sc-pYcnE kSkqbf second-td">-₹55.2</div>
                        </div>
                        <div class="sc-pQfvp eqCZOB">
                            <div class="sc-pYcnE kSkqbf first-td">GST</div>
                            <div class="sc-pYcnE kSkqbf second-td">-₹13</div>
                        </div>
                        <hr class="sc-oUAoT gUkkcK">
                        <div class="sc-pQfvp eqCZOB light-background">
                            <div class="sc-pYcnE kSkqbf first-td">How much you make *</div>
                            <div class="sc-pYcnE kSkqbf second-td settlement_value">₹114.8</div>
                        </div>
                    </div>
                    <div class="sc-pcxhi kMxZOc">* This may vary by category, product price, shipping volume and distance, applicable taxes etc.</div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>
</section>
@endsection

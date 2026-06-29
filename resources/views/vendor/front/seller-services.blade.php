@extends('layouts.vendor-front') 
@section('content')
<h2 class="Heading-3 text-center border-bottom">Services</h2>
<section class="main py-5 serviceBox">
    <div class="container">
        <h4 class=" mb-5">Minimum cost with maximum benefits</h4>
        <div class="row">
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{asset('assets/vendor_template/images/Flipkart Fulfilment.png')}}" alt="">
                        <h4>Ecomerce Fulfilment</h4>
                        <div><span>Ecomerce Admin</span> | <span>13th Dec, 2020</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{asset('assets/vendor_template/images/Smart Fulfilment.png')}}" alt="">
                        <h4>Smart Fulfilment</h4>
                        <div><span>Ecomerce Admin</span> | <span>13th Dec, 2020</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{asset('assets/vendor_template/images/Packaging.png')}}" alt="">
                        <h4>Ecomerce Branded Packaging</h4>
                        <div><span>Ecomerce Admin</span> | <span>13th Dec, 2020</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{asset('assets/vendor_template/images/PAM.png')}}" alt="">
                        <h4>Paid Account Management (PAM)</h4>
                        <div><span>Ecomerce Admin</span> | <span>13th Dec, 2020</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
        </div>
    </div>
</section>
@endsection

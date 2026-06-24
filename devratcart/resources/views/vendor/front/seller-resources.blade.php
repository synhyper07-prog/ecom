@extends('layouts.vendor-front') 
@section('content')
<h2 class="Heading-3 text-center border-bottom">Resources</h2>
<section class="main py-5 serviceBox">
    <div class="container">
        <h4 class=" mb-5">Enhancing your selling experience</h4>
        <div class="row">
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{ asset('assets/vendor_template/images/onl.png') }}" alt="">
                        <h4>Online Selling Guide</h4>
                        <div><span>Ratcart Admin</span> | <span>1st January, 2021</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{ asset('assets/vendor_template/images/Wall of fame-01.png') }}" alt="">
                        <h4>Seller Success Stories</h4>
                        <div><span>Ratcart Admin</span> | <span>1st January, 2021</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{ asset('assets/vendor_template/images/pro_0.png') }}" alt="">
                        <h4>Products in Demand</h4>
                        <div><span>Ratcart Admin</span> | <span>1st January, 2021</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
        </div>
        <hr class="mb-5">
        <div class="row">
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{ asset('assets/vendor_template/images/slc.png') }}" alt="">
                        <h4>Seller Learning Center</h4>
                        <div><span>Ratcart Admin</span> | <span>1st January, 2021</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{ asset('assets/vendor_template/images/news.png') }}" alt="">
                        <h4>Ratcart in News</h4>
                        <div><span>Ratcart Admin</span> | <span>1st January, 2021</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-md-4">
                <figure>
                    <a href="#0">
                        <img src="{{ asset('assets/vendor_template/images/L1-01_0.png') }}" alt="">
                        <h4>Samriddhi Workshop</h4>
                        <div><span>Ratcart Admin</span> | <span>1st January, 2021</span> | <span>1 minute</span></div>
                    </a>
                </figure>
            </div>
        </div>
    </div>
</section>
@endsection

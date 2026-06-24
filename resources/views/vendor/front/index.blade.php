@extends('layouts.vendor-front') 
@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('assets/vendor_template/images/WP_banner_3.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{asset('assets/vendor_template/images/WP_banner_3.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{asset('assets/vendor_template/images/WP_banner_3.png')}}" class="d-block w-100" alt="...">
        </div>
        @php    if(!Auth::guard('web')->check()){  @endphp
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="mb-4">Join Us Now!</h3>
                        <form>
                            <div class="form-group d-flex" style="margin-left: 14rem !important;">
                                <input type="email" class="form-control w-50 mr-3" placeholder="Enter email address">
                                <a class="btn btn-warning w-25" href="{{route('vendor-register')}}">Register Now!</a>
                            </div>
                        </form>
                    </div>
        @php    }   @endphp    
    </div>
    <a class="carousel-control-prev d-inline-flex" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next d-inline-flex" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section class="sellOn py-5 border-top">
    <div class="container">
    	<h4 class="text-center mb-5">RATCART SELLER HUB</h4>
        <ul>
        	<li>
                <p><strong>Ease of handing- </strong>Ease of sales get full sales support,from end to end. manegement of your stores, catalogs, and supply chain manegment. focus on your brand taking care of rest.</p>
        	</li>
        	<li>
                <p><strong>Quick and secure payments- </strong>payment work quick and secure ratcart give you timely payment with complete transparency.</p>
        	</li>
        	<li>
                <p><strong>Development through marketing- </strong>Benifit from better expertise like in multichannel promotinde campaingns, digital marketing,social media with your consumeya.</p>
        	</li>
        	<li>
                <p><strong>Account maneger- </strong>Ratcart gives you easy to handle platform for manege your accounts simply and grow your sales mountaning.</p>
        	</li>
        	<li>
                <p><strong>Good seller support- </strong>Ratcart has a very good team will always avlaible to solve any issue,if you have question.</p>
        	</li>
        	<li>
                <p><strong>Logistic support- </strong>Ratcart give you better logistic support with our best courier partner.</p>
        	</li>
        </ul>
    </div>
</section>
<section class="my-5 faqService">
    <div class="container">
        <nav class="mb-4">
            <div class="nav nav-tabs justify-content-around" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">WHY SELL ONLINE</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">WHY SELL WITH RATCART</a>
                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">WHY SELL WITH RATCART</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col-md-3">
                        <figure class="circleBox">
                            <div class="boxCircle">
                                1
                            </div>
                            <h5>SELL ON RATCART</h5>
                            <p>Online selling is more faster then particular shop online sell covered more city more customer more selling  products. even when you shop will be closed you don,t need barginig any more with any customer.</p>
                           {{--  <ul class="pl-3">
                                <li>Avoid huge investments.</li>
                                <li>Large customer base to sell anywhere.</li>
                            </ul> --}}
                        </figure>
                    </div>
                    <div class="col-md-3">
                        <figure class="circleBox">
                            <div class="boxCircle">
                                2
                            </div>
                            <h5>SHIP WITH EASY</h5>
                            <p>You only need to package the product. and enjoy easy pickup delivery with our logistic partner.</p>
                            {{-- <ul class="pl-3">
                                <li>Avoid huge investments.</li>
                                <li>Large customer base to sell anywhere.</li>
                            </ul> --}}
                        </figure>
                    </div>
                    <div class="col-md-3">
                        <figure class="circleBox">
                            <div class="boxCircle">
                                3
                            </div>
                            <h5>EARN BIG</h5>
                            <p>More product sell in at a time to get your payment in as seven to fifteen days when order deliver succsesfull our payment partner razorpay benifit of selling on ratcart.</p>
                            {{-- <ul class="pl-3">
                                <li>Avoid huge investments.</li>
                                <li>Large customer base to sell anywhere.</li>
                            </ul> --}}
                        </figure>
                    </div>
                    <div class="col-md-3">
                        <figure class="circleBox">
                            <div class="boxCircle">
                                4
                            </div>
                            <h5>GST DETAIL</h5>
                            <p>You have succsesfully register on ratcart as a vendor you need to confirm GST detail.</p>
                            {{-- <ul class="pl-3">
                                <li>Avoid huge investments.</li>
                                <li>Large customer base to sell anywhere.</li>
                            </ul> --}}
                        </figure>
                    </div>
                    <div class="col-md-3">
                        <figure class="circleBox">
                            <div class="boxCircle">
                                5
                            </div>
                            <h5>CANCEL CHECK</h5>
                            <p>All you need to be register on ratcart you have one cancellation check will be uploaded on our vendor form.</p>
                            {{-- <ul class="pl-3">
                                <li>Avoid huge investments.</li>
                                <li>Large customer base to sell anywhere.</li>
                            </ul> --}}
                        </figure>
                    </div>
                </div>
                <div class="text-center mt-5">
                   {{--  <a href="#0" class="btn btn-link">Learn More</a> --}}
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-center">#NayeIndiaKeSellers</h5>
                        <iframe width="100%" height="254" src="https://www.youtube.com/embed/BSngQTp5_7A" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                      {{--   <a href="#0">Learn More</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                      {{--   <a href="#0">Learn More</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                       {{--  <a href="#0">Learn More</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                      {{--   <a href="#0">Learn More</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-center">#NayeIndiaKeSellers</h5>
                        <iframe width="100%" height="254" src="https://www.youtube.com/embed/BSngQTp5_7A" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                        <a href="#0">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                        <a href="#0">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                        <a href="#0">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-3"><img src="{{asset('assets/vendor_template/images/online-shop.png')}}" alt=""></div>
                                    <div>
                                        <h4>Growth</h4>
                                        <p>Widen your reach to a customer base of 1 billion and grow your business further with the support of Account managers.</p>
                                       {{--  <a href="#0">Learn More</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section class="grow">
    <div class="container">
        <div class="text-center">
            <h4>GROW FASTER WITH RATCART</h4>
            <a href="#0" class="btn btn-link">Know more</a>
        </div>
    </div>
    <img src="{{asset('assets/vendor_template/images/grow_faster_new.png')}}" class="w-100" alt="">
</section> --}}
<section class="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<h5 align="center">RATCART</h5>
                <div class="d-flex">
                    <div class="w-50  mr-3">
                        <img class="img-thumbnail mr-3" src="https://ratcart.com/assets/vendor_template/images/ratcart.png" alt="">
                    </div>
                    <div>
                        <p><i>Offer you to sell product with low cost commisson. our ratcart open for transparency no hidden charge, transparency on delivery charge depend on the product weight dimention and a small fix feet.</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sellOn py-5 border-top">
    <div class="container">
        <h4 class="text-center mb-5">SELL ON RATCART</h4>
        <p>Ratcart market place for selling online product are lisiting in our product category with minimum charges or investment our team export helping you to sell product on ratcart. it gives you full seller support ratcart always on how to deliver more products in india.</p>
    </div>
</section>
<section class="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="w-50  mr-3">
                        <img class="img-thumbnail mr-3" src="https://img1a.flixcart.com/fk-sellerhub/24th-Nov-2020TDubbJZjsRVeW6q-fRjQ24-QAexlqpmt/U_and_I_World.png" alt="">
                    </div>
                    <div>
                        <p><i>This year’s BBD was great! Got 4X growth in my sales and I feel extremely happy about it.</i></p>
                        <h6>Meet Vij, Cherry Enterprise</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="w-50  mr-3">
                        <img class="img-thumbnail mr-3" src="https://img1a.flixcart.com/fk-sellerhub/24th-Nov-2020TDubbJZjsRVeW6q-fRjQ24-QAexlqpmt/U_and_I_World.png" alt="">
                    </div>
                    <div>
                        <p><i>This year’s BBD was great! Got 4X growth in my sales and I feel extremely happy about it.</i></p>
                        <h6>Meet Vij, Cherry Enterprise</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="w-50  mr-3">
                        <img class="img-thumbnail mr-3" src="https://img1a.flixcart.com/fk-sellerhub/24th-Nov-2020TDubbJZjsRVeW6q-fRjQ24-QAexlqpmt/U_and_I_World.png" alt="">
                    </div>
                    <div>
                        <p><i>This year’s BBD was great! Got 4X growth in my sales and I feel extremely happy about it.</i></p>
                        <h6>Meet Vij, Cherry Enterprise</h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

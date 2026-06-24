@extends('layouts.vendor-front') 
@section('content')
<h2 class="Heading-3 text-center border-bottom">FAQs</h2>\
<section class="my-5 faqService">
    <div class="container">
        <nav class="mb-4">
            <div class="nav nav-tabs justify-content-around" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Getting Started</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pricing and Payments</a>
                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Listings and Catalog</a>
                <a class="nav-link" id="nav-manage-tab" data-toggle="tab" href="#nav-manage" role="tab" aria-controls="nav-manage" aria-selected="false">Order Management and Shipping</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="accordion" id="accordion1">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Why Should I sell on Flipkart?</button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                            <div class="card-body">
                                Flipkart is the leader in Indian e-commerce with maximum online reach and highest credibility. With more than 10 crore registered customers, 10 million daily page visits and the lowest cost of doing business, we are the strongest partner to take your
                                products to customers all over India. We have sale events that give each seller an equal opportunity to grow their business online.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Who can sell on Flipkart?</button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion1">
                            <div class="card-body">
                                <p>Anyone selling new and genuine products is welcome. In order to start selling, you need to have :</p>
                                <p>GSTIN</p>
                                <p>Cancelled Cheque</p>
                                <p>Sample Signatures</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How do I sell on Flipkart?</button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion1">
                            <div class="card-body">
                                <p>To sell on Flipkart:</p>
                                <ol>
                                    <li>
                                        <p>Register yourself at <a href="https://seller.flipkart.com" target="_blank">seller.flipkart.com</a>.</p>
                                    </li>
                                    <li>
                                        <p>List your products under specific product categories.</p>
                                    </li>
                                    <li>
                                        <p>On receiving an order, pack the product and mark it as ‘Ready to Dispatch’. Our logistics partner will pick up the product and deliver it to the customer.</p>
                                    </li>
                                    <li>
                                        <p>After your order is successfully dispatched, Flipkart will settle your payment within 7-15 business days based on your seller tier.</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="accordion" id="accordion2">
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Why Should I sell on Flipkart?</button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordion2">
                            <div class="card-body">
                                Flipkart is the leader in Indian e-commerce with maximum online reach and highest credibility. With more than 10 crore registered customers, 10 million daily page visits and the lowest cost of doing business, we are the strongest partner to take your
                                products to customers all over India. We have sale events that give each seller an equal opportunity to grow their business online.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">Who can sell on Flipkart?</button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion2">
                            <div class="card-body">
                                <p>Anyone selling new and genuine products is welcome. In order to start selling, you need to have :</p>
                                <p>GSTIN</p>
                                <p>Cancelled Cheque</p>
                                <p>Sample Signatures</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">How do I sell on Flipkart?</button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion2">
                            <div class="card-body">
                                <p>To sell on Flipkart:</p>
                                <ol>
                                    <li>
                                        <p>Register yourself at <a href="https://seller.flipkart.com" target="_blank">seller.flipkart.com</a>.</p>
                                    </li>
                                    <li>
                                        <p>List your products under specific product categories.</p>
                                    </li>
                                    <li>
                                        <p>On receiving an order, pack the product and mark it as ‘Ready to Dispatch’. Our logistics partner will pick up the product and deliver it to the customer.</p>
                                    </li>
                                    <li>
                                        <p>After your order is successfully dispatched, Flipkart will settle your payment within 7-15 business days based on your seller tier.</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                Accordians
            </div>
            <div class="tab-pane fade" id="nav-manage" role="tabpanel" aria-labelledby="nav-manage-tab">
                Accordians 2
            </div>
        </div>
    </div>
</section>
@endsection

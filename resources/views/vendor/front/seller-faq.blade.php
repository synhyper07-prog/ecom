@extends('layouts.vendor-front') 
@section('content')
<h2 class="Heading-3 text-center border-bottom">FAQs</h2>
<section class="my-5 faqService">
    <div class="container">
        <nav class="mb-4">
            <div class="nav nav-tabs justify-content-around" id="nav-tab" role="tablist">
                @foreach($data as $key=>$item_value)
                   <a class="nav-link" aria-selected="true" onclick="get_faq_detail('{{ $item_value->id }}');"  href="javascript:void(0);" role="tab" >{{ $item_value->heading }}</a>
                @endforeach   
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent"></div>
    </div>
</section>
<script>
    function get_faq_detail(id){
        $.ajax({
            type: "GET",
            url:"http://ratcart.knovatik.com/seller/vendor-faq-by-id/"+id,
            success: function (data) {
                $('#nav-tabContent').html(data);
            }
        });
    }
</script>
@endsection


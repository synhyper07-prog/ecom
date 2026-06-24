@extends('layouts.seller')
@section('content')
<section class="login-signup">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="tab-content" id="nav-tabContent">
                <div class="login-area signup-area">
                    <div class="header-area">
                        <h4 class="title">Register now</h4>
                    </div>
                    <div class="login-form signup-form">
                        @include('includes.admin.form-login')
                        @if($errors->has('error_message'))
                          <div class="alert alert-danger validation" style="">
                            <button type="button" class="close alert-close"><span>×</span></button>
                            <p class="text-left">Credentials Doesn't Match !</p> 
                          </div>
                        @endif
                        <form  action="{{route('vendor-register-submit')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-input">
                                    <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required=""><i class="icofont-user-alt-5"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                      <i class="icofont-email"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6 ">
                                  <ul class="captcha-area">
                                    <li>
                                        <div class="form-input">
                                            <p><input type="text" class="User Name" name="phone" id="phone_no" placeholder="{{ $langg->lang184 }}"  required=""><i class="icofont-phone"></i></p>
                                        </div>  
                                        <p style="margin-top: -14px !important; color: red;" id="otp_link_div"><a href="javascript:void(0);" id="otp_form" style="color: red !important; text-decoration: underline red;">Verify Mobile No.</a></p>
                                        <p style="margin-top: -14px !important; color: green; display: none;" id="otp_verify_div"><a href="#" id="otp_verify_div" style="color: green !important;">Mobile No verified</a></p>
                                        <div class="form-input" id="otp_input_div"  style="display: none;">
                                            <p style="margin-top: -14px !important; color: red;" >
                                                <input type="text" class="User Name" name="otp" id="otp" placeholder="Enter otp" style="background: #f8f9fa0d; width: 70%">
                                                <a href="javascript:void(0);"  class="verify-btn" style="width: 20%; background: #47a010;" id="verify_otp">Verify</a>
                                            </p>
                                        </div>   
                                    </li>
                                  </ul>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                      <i class="icofont-location-pin"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="shop_name" placeholder="{{ $langg->lang238 }}" required="">
                                      <i class="icofont-cart-alt"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="owner_name" placeholder="{{ $langg->lang239 }}" required="">
                                      <i class="icofont-cart"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="shop_number" placeholder="{{ $langg->lang240 }}" required="">
                                      <i class="icofont-shopping-cart"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="shop_address" placeholder="{{ $langg->lang241 }}" required="">
                                      <i class="icofont-opencart"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="reg_number" placeholder="{{ $langg->lang242 }}" required="">
                                      <i class="icofont-ui-cart"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="text" class="User Name" name="shop_message" placeholder="{{ $langg->lang243 }}" required="">
                                      <i class="icofont-envelope"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                      <i class="icofont-ui-password"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                      <i class="icofont-ui-password"></i>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <input type="file" title =" Choose profile pic " class="file" id="files" name="user_image"   aria-label="File browser example"  required=""><i class="" style="margin-top: 11px;">Vendor Image</i> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                    <input type="file" title =" Choose profile pic " class="file" id="files" name="user_signature"   aria-label="File browser example"  required=""><i class="" style="margin-top: 11px;">Vendor Signature</i> 
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-input">
                                      <input type="file" title =" Choose Adhar card " class="file" id="files" name="user_adhar_card"   aria-label="File browser example"  required=""><i class="" style="margin-top: 11px;">Adhar card</i> 
                                  </div>
                                </div>
                                <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    $( "#otp_form" ).click(function(){
      if($("#phone_no").val() =="" ){
        alert("Mobile no can not be blank");
      }
      else{
          var mobile = $("#phone_no").val();
          $.ajax({
              method:"GET",
              url:"{{ route('front.sendotp') }}/"+mobile,
                success:function(data){
                  if ((data.errors)){
                    alert("Mobile user already exists");
                  }
                  else{
                    $('#phone_no').attr('readonly', true); 
                    $("#otp_link_div").hide();
                    $("#otp_input_div").show();
                  }
              }
          });
      }    
    });

    $( "#verify_otp" ).click(function(){
      if($("#phone_no").val() =="" ){
        alert("Mobile no can not be blank");
      }
      if($("#otp").val() =="" ){
        alert("Otp can not be blank");
      }
      else{
          var mobile = $("#phone_no").val();
          var otp    = $("#otp").val();
          $.ajax({
              method:"GET",
              url:"{{ route('front.verifyotp') }}/"+mobile+'/'+otp,
              success:function(data){
                if ((data.errors)) {
                  alert("Otp does not match");
                  $("#otp_link_div").hide();
                  $("#otp_input_div").show();
                }
                else{
                  $("#otp_link_div").hide();
                  $("#otp_input_div").hide();
                  $("#otp_verify_div").show();
                  $(".submit-btn").attr("disabled", false);
                }
              }
          });
      }    
    });
</script>
@yield('scripts')
@endsection
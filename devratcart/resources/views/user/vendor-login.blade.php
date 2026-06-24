@extends('layouts.seller')
@section('content')
<section class="login-signup">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-6">
              <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
                      <div class="login-area">
                          <div class="header-area">
                              <h4 class="title">{{ $langg->lang172 }}</h4>
                          </div>
                          <div class="login-form signin-form">
                              @include('includes.admin.form-login')
                              @if($errors->has('error_message'))
                                <div class="alert alert-danger validation" style="">
                                    <button type="button" class="close alert-close"><span>×</span></button>
                                    <p class="text-left">Credentials Doesn't Match !</p> 
                                </div>
                              @endif  
                              <form  action="{{ route('vendor.login.submit') }}" method="POST">
                                  {{ csrf_field() }}
                                  <div class="form-input">
                                      <input type="text" name="email" placeholder="Type Email Address Or Mobile No." required="">
                                      <i class="icofont-user-alt-5"></i>
                                  </div>
                                  <div class="form-input">
                                      <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
                                      <i class="icofont-ui-password"></i>
                                  </div>
                                  <div class="form-forgot-pass">
                                    <div class="left">
                                        <input type="checkbox" name="remember" id="mrp" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="mrp">{{ $langg->lang175 }}</label>
                                    </div>
                                    <div class="right">
                                      <a href="{{ route('user-forgot') }}">{{ $langg->lang176 }}</a>
                                    </div>
                                  </div>
                                  <input type="hidden" name="modal" value="1">
                                  <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                                  <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
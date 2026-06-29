<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($productt))
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
	    <meta name="author" content="Ecomerce">
    	<title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
    @else
	    <meta name="keywords" content="Ecomerce">
	    <meta name="author"   content="Ecomerce">
		<title>{{$gs->title}}</title>
    @endif
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	@if($langg->rtl == "1")
		<!-- stylesheet -->
		<link rel="stylesheet" href="{{asset('assets/front/css/rtl/all.css')}}">
	    <!--Updated CSS-->
	 	<link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
	@else
		<!-- stylesheet -->
		<link rel="stylesheet" href="{{asset('assets/front/css/all.css')}}">
	    <!--Updated CSS-->
	 	<link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
	@endif
	@yield('styles')
	<style type="text/css">
		    .logo-header .search-box .categori-container .categoris option {
			    background: none !important; 
			}
			.verify-btn{
			    height: 48px;
			    text-align: center;
			    border: 0px;
			    color: #fff;
			    font-weight: 700;
			    text-transform: uppercase;
			    margin-top: 20px;
			    -o-transition: all 0.3s ease-in;
			    transition: all 0.3s ease-in;
			    cursor: pointer;
			    margin: 0;
			    font-family: inherit;
			    font-size: inherit;
			    line-height: inherit;
			    border-radius: 0;
			    box-sizing: border-box;
			    -webkit-writing-mode: horizontal-tb !important;
                text-rendering: auto;
                letter-spacing: normal;
                word-spacing: normal;
                text-indent: 0px;
			    text-shadow: none;
			    display: inline-block;
			    align-items: flex-start;
			    font: 400 13.3333px Arial;
                padding: 17px 6px;
			}
	</style>
</head>
<body>
@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
	@endif
	<div class="xloader d-none" id="xloader" style="background: url({{asset('assets/front/images/xloading.gif')}}) no-repeat scroll center center #FFF;"></div>
@if($gs->is_popup== 1)
@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->popup_background)}}">
    </div>
@endif
@endif
	<section class="logo-header">
		<div class="container">
			<div class="row ">
				<div class="col-lg-2 col-sm-6 col-5 remove-padding">
					<div class="logo">
						<a href="{{ route('front.index') }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->
    @yield('content')
	<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="footer-info-area">
						<div class="footer-logo">
							<a href="{{ route('front.index') }}" class="logo-link">
								<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
							</a>
						</div>
						<div class="text">
							<p>{!! $gs->footer !!}</p>
						</div>
					</div>
					<div class="fotter-social-links">
						<ul>
	                   	    @if($socialsetting->f_status == 1)
	                            <li><a href="{{ $socialsetting->facebook }}" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
	                          @endif
	                          @if($socialsetting->g_status == 1)
	                            <li><a href="{{ $socialsetting->gplus }}" class="google-plus" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
	                          @endif
	                          @if($socialsetting->t_status == 1)
	                            <li><a href="{{ $socialsetting->twitter }}" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>
	                          @endif
	                          @if($socialsetting->l_status == 1)
	                            <li>
		                            <a href="{{ $socialsetting->linkedin }}" class="linkedin" target="_blank">
		                                <i class="fab fa-linkedin-in"></i>
		                            </a>
	                            </li>
	                          @endif
	                          @if($socialsetting->d_status == 1)
	                            <li>
		                            <a href="{{ $socialsetting->dribble }}" class="dribbble" target="_blank">
		                                <i class="fab fa-dribbble"></i>
		                            </a>
	                            </li>
	                        @endif

						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
								{{ $langg->lang21 }}
						</h4>
						<ul class="link-list">
							<li>
								<a href="{{ route('front.index') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang22 }}
								</a>
							</li>

							@foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							<li>
								<a href="{{ route('front.page',$data->slug) }}">
									<i class="fas fa-angle-double-right"></i>{{ $data->title }}
								</a>
							</li>
							@endforeach

							<li>
								<a href="{{ route('front.contact') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang23 }}
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							{{ $langg->lang24 }}
						</h4>
						<ul class="post-list">
							@foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get() as $blog)
							<li>
								<div class="post">
								  <div class="post-img">
									<img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
								  </div>
								  <div class="post-details">
									<a href="{{ route('front.blogshow',$blog->id) }}">
										<h4 class="post-title">
											{{mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title}}
										</h4>
									</a>
									<p class="date">
										{{ date('M d - Y',(strtotime($blog->created_at))) }}
									</p>
								  </div>
								</div>
							  </li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-md-5 col-lg-5">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">Payment Partners</h4>
						<ul class="post-list">
							<li>
								<div class="post">
								  <div class="post-img">
									<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
								  </div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 col-lg-5">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">Delivery Partners</h4>
						<ul class="post-list">
							<li>
								<div class="post">
								  <div class="post-img">
									<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
								  </div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="copy-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
							<div class="content">
								<div class="content">
									<p>{!! $gs->copyright !!}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->

	<!-- LOGIN MODAL -->
	<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<nav class="comment-log-reg-tabmenu">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"
								role="tab" aria-controls="nav-log" aria-selected="true">
								{{ $langg->lang197 }}
							</a>
							<a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"
								aria-controls="nav-reg" aria-selected="false">
								{{ $langg->lang198 }}
							</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-log1" role="tabpanel"
							aria-labelledby="nav-log-tab1">
							<div class="login-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang172 }}</h4>
								</div>
								<div class="login-form signin-form">
									@include('includes.admin.form-login')
									<form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
										{{ csrf_field() }}
										<div class="form-input">
											<input type="email" name="email" placeholder="{{ $langg->lang173 }}"
												required="">
											<i class="icofont-user-alt-5"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang174 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-forgot-pass">
											<div class="left">
												<input type="checkbox" name="remember" id="mrp"
													{{ old('remember') ? 'checked' : '' }}>
												<label for="mrp">{{ $langg->lang175 }}</label>
											</div>
											<div class="right">
												<a href="javascript:;" id="show-forgot">
													{{ $langg->lang176 }}
												</a>
											</div>
										</div>
										<input type="hidden" name="modal" value="1">
										<input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
										@if($socialsetting->f_check == 1 ||
										$socialsetting->g_check == 1)
										<div class="social-area">
											<h3 class="title">{{ $langg->lang179 }}</h3>
											<p class="text">{{ $langg->lang180 }}</p>
											<ul class="social-links">
												@if($socialsetting->f_check == 1)
												<li>
													<a href="{{ route('social-provider','facebook') }}">
														<i class="fab fa-facebook-f"></i>
													</a>
												</li>
												@endif
												@if($socialsetting->g_check == 1)
												<li>
													<a href="{{ route('social-provider','google') }}">
														<i class="fab fa-google-plus-g"></i>
													</a>
												</li>
												@endif
											</ul>
										</div>
										@endif
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
							<div class="login-area signup-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang181 }}</h4>
								</div>
								<div class="login-form signup-form">
									@include('includes.admin.form-login')
									<form class="mregisterform" action="{{route('user-register-submit')}}"
										method="POST">
										{{ csrf_field() }}

										<div class="form-input">
											<input type="text" class="User Name" name="name"
												placeholder="{{ $langg->lang182 }}" required="">
											<i class="icofont-user-alt-5"></i>
										</div>

										<div class="form-input">
											<input type="email" class="User Name" name="email"
												placeholder="{{ $langg->lang183 }}" required="">
											<i class="icofont-email"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="phone"
												placeholder="{{ $langg->lang184 }}" required="">
											<i class="icofont-phone"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="address"
												placeholder="{{ $langg->lang185 }}" required="">
											<i class="icofont-location-pin"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang186 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password_confirmation"
												placeholder="{{ $langg->lang187 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>


										@if($gs->is_capcha == 1)

										<ul class="captcha-area">
											<li>
												<p><img class="codeimg1"
														src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
														class="fas fa-sync-alt pointer refresh_code "></i></p>
											</li>
										</ul>

										<div class="form-input">
											<input type="text" class="Password" name="codes"
												placeholder="{{ $langg->lang51 }}" required="">
											<i class="icofont-refresh"></i>
										</div>


										@endif

										<input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGIN MODAL ENDS -->

	<!-- FORGOT MODAL -->
	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="login-area">
						<div class="header-area forgot-passwor-area">
							<h4 class="title">{{ $langg->lang191 }} </h4>
							<p class="text">{{ $langg->lang192 }} </p>
						</div>
						<div class="login-form">
							@include('includes.admin.form-login')
							<form id="mforgotform" action="{{route('user-forgot-submit')}}" method="POST">
								{{ csrf_field() }}
								<div class="form-input">
									<input type="email" name="email" class="User Name"
										placeholder="{{ $langg->lang193 }}" required="">
									<i class="icofont-user-alt-5"></i>
								</div>
								<div class="to-login-page">
									<a href="javascript:;" id="show-login">
										{{ $langg->lang194 }}
									</a>
								</div>
								<input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
								<button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- FORGOT MODAL ENDS -->


<!-- VENDOR LOGIN MODAL -->
	<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">
	    <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
		        </div>
		        <div class="modal-body">
					<nav class="comment-log-reg-tabmenu">
						<div class="nav nav-tabs" id="nav-tab1" role="tablist">
							<a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
								{{ $langg->lang234 }}
							</a>
							<a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
								{{ $langg->lang235 }}
							</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
					        <div class="login-area">
					          <div class="login-form signin-form">
					            @include('includes.admin.form-login')
					            <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
					                {{ csrf_field() }}
					                <div class="form-input">
						                <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
						                <i class="icofont-user-alt-5"></i>
					                </div>
					                <div class="form-input">
						                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
						                <i class="icofont-ui-password"></i>
					                </div>
					                <div class="form-forgot-pass">
						                <div class="left">
						                  <input type="checkbox" name="remember"  id="mrp1" {{ old('remember') ? 'checked' : '' }}>
						                  <label for="mrp1">{{ $langg->lang175 }}</label>
						                </div>
						                <div class="right">
						                  <a href="javascript:;" id="show-forgot1">
						                    {{ $langg->lang176 }}
						                  </a>
						                </div>
					                </div>
					                <input type="hidden" name="modal"  value="1">
					                <input type="hidden" name="vendor"  value="1">
					                <input class="mauthdata" type="hidden"  value="{{ $langg->lang177 }}">
					                <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
						                @if($socialsetting->f_check == 1 || $socialsetting->g_check == 1)
							                <div class="social-area">
							                    <h3 class="title">{{ $langg->lang179 }}</h3>
							                    <p class="text">{{ $langg->lang180 }}</p>
							                    <ul class="social-links">
								                    @if($socialsetting->f_check == 1)
								                       <li><a href="{{ route('social-provider','facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
								                    @endif
								                    @if($socialsetting->g_check == 1)
								                       <li><a href="{{ route('social-provider','google') }}"><i class="fab fa-google-plus-g"></i></a></li>
								                    @endif
							                    </ul>
							                </div>
						                @endif
					            </form>
					          </div>
					        </div>
						</div>
						<div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
			                <div class="login-area signup-area">
			                    <div class="login-form signup-form">
			                       @include('includes.admin.form-login')
			                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
			                            {{ csrf_field() }}
				                        <div class="row">
				                            <div class="col-lg-6">
				                                <div class="form-input">
					                                <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
					                                <i class="icofont-user-alt-5"></i>
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
						                                    <p>
						                                    	<input type="text" class="User Name" name="phone" id="phone_no" placeholder="{{ $langg->lang184 }}"  required=""><i class="icofont-phone"></i>
						                                    </p>
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
				                            @if($gs->is_capcha == 1)
												<div class="col-lg-6">
												    <ul class="captcha-area">
												        <li>
												         	<p>
												         		<img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
												         	</p>

												        </li>
												    </ul>
												</div>
						                        <div class="col-lg-6">
						                            <div class="form-input">
						                                <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
						                                <i class="icofont-refresh"></i>
						                            </div>
						                        </div>
				                            @endif
								            <input type="hidden" name="vendor"  value="1">
				                            <input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
				                            <button type="submit" class="submit-btn" disabled="disabled">{{ $langg->lang189 }}</button>
				                        </div>
			                        </form>
			                    </div>
			                </div>
						</div>
					</div>
		        </div>
		    </div>
	    </div>
    </div>
<!-- VENDOR LOGIN MODAL ENDS -->

<!-- Product Quick View Modal -->

	  <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<div class="container quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal -->

<!-- Order Tracking modal Start-->
    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
	            <div class="modal-header">
	                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <div class="order-tracking-content">
	                    <form id="track-form" class="track-form">
	                        {{ csrf_field() }}
	                        <input type="text" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
	                        <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
	                        <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
	                    </form>
	                </div>
	                <div>
			            <div class="submit-loader d-none">
							<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
						</div>
						<div id="track-order">

						</div>
	                </div>
	            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->
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
<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode(\App\Models\Generalsetting::first()->makeHidden(['stripe_key', 'stripe_secret', 'smtp_pass', 'instamojo_key', 'instamojo_token', 'paystack_key', 'paystack_email', 'paypal_business', 'paytm_merchant', 'paytm_secret', 'paytm_website', 'paytm_industry', 'paytm_mode', 'molly_key', 'razorpay_key', 'razorpay_secret'])) !!};
  var langg    = {!! json_encode($langg) !!};
</script>

	<!-- jquery -->
	{{-- <script src="{{asset('assets/front/js/all.js')}}"></script> --}}
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/js/vue.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- popper -->
	<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>

	<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>

    {!! $seo->google_analytics !!}

	@if($gs->is_talkto == 1)
		<!--Start of Tawk.to Script-->
		{!! $gs->talkto !!}
		<!--End of Tawk.to Script-->
	@endif

	@yield('scripts')

</body>

</html>

@extends('layouts.admin')
@section('styles')
<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Seller Faq') }} <a class="add-btn"
						href="{{ route('admin.seller.seller-faq-list') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="{{ route('admin.seller.seller-faq-list') }}">{{ __('All Selle Faq') }}</a>
					</li>
					<li>
						<a href="#">{{ __('View Seller Faq') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<form>
		{{csrf_field()}}
		<input type="hidden" class="input-field" name="seller_faq_id" value="{{ $data->id }}">	
		<div class="row">
			<div class="col-lg-8">
				<div class="add-product-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="product-description">
								<div class="body-area">
									<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
									@include('includes.admin.form-both')
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Heading') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Faq Heading') }}" name="heading" value="{{ $data->heading }}" readonly="">
										</div>
									</div>
									<div class="row">
										@foreach($data->list as $key=>$item_value)
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Detail') }}* </h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="feature-tag-top-filds" id="feature-section">
													<div class="feature-area">
														@if($key==0)  @else <span class="remove feature-remove"><i class="fas fa-times"></i></span> @endif
														<div class="row">
															<div class="col-lg-6">
																<input type="text" name="sub_heading[]" value="{{ $item_value->sub_heading }}" class="input-field" placeholder="{{ __('Enter Sub headings') }}" readonly="">
															</div>
															<div class="col-lg-6">
																<textarea class="input-field" name="details[]" placeholder="Enter Description" readonly="">{{ $item_value->detail }}</textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										@endforeach	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
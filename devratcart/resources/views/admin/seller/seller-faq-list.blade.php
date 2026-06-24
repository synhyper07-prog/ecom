@extends('layouts.admin')
@section('content')
<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Seller Seller Faq') }}</h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="{{ route('admin.seller.seller-faq-list') }}">{{ __('Seller Faq') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="product-area">
		<div class="row">
			<div class="col-lg-12">
				<div class="mr-table allproduct">
					@if(session()->has('message'))
                       <div class="alert alert-success validation"><button type="button" class="close alert-close"><span>×</span></button><p class="text-left"></p>{{ session()->get('message')}} </div>
                    @endif   
					<div class="table-responsiv">
						<div class="row btn-area " style="float: right;">
						    <div class="col-lg-12 table-contents">
						   	    <a class="add-btn" href="{{ route('admin.seller.seller-faq-form') }}"><i class="fas fa-plus"></i> Add New Faq</a>
						   	</div>
						</div>
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ __('#') }}</th>
			                        <th>{{ __('Heading') }}</th>
			                        <th>{{ __('Action') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $key => $value)
									<tr>
										<td>@php echo $key + 1;  @endphp</td>
										<td>{{ $value->heading }}</td>
										<td>
											<div class="godropdown">
											    <button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button>
											    <div class="action-list" style="display: none;">
											       <a href="{{ route('admin.seller.view-seller-faq-detail', $value->id) }}"> <i class="fas fa-eye"></i> View</a>
											       <a href="{{ route('admin.seller.edit-seller-faq', $value->id) }}"> <i class="fas fa-edit"></i> Edit</a>
											       <a href="{{ route('admin.seller.delete-seller-faq', $value->id) }}" ><i class="fas fa-trash-alt"></i> Delete</a>
											    </div>
											</div>
										</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection

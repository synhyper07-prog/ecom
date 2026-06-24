@extends('layouts.admin')
@section('content')
<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Seller shipping price') }}</h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="{{ route('admin.seller.index') }}">{{ __('Seller shipping price') }}</a>
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
						   	    <a class="add-btn" data-href="{{ route('admin.seller.create-price-slab') }}" id="add-data" data-toggle="modal" data-target="#slab_modal"><i class="fas fa-plus"></i> Add New Slab</a>
						   	</div>
						</div>
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ __('#') }}</th>
			                        <th>{{ __('Slab') }}</th>
			                        <th>{{ __('LOCAL (INTRACITY)') }}</th>
									<th>{{ __('ZONAL (INTRAZONE)') }}</th>
			                        <th>{{ __('NATIONAL (INTERZONE)') }}</th>
			                        <th>{{ __('Updated at') }}</th>
			                        <th>{{ __('Created at') }}</th>
			                        <th>{{ __('Action') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $key => $value)
									<tr>
										<td>@php echo $key + 1;  @endphp</td>
										<td>{{ $value->weight_slab }}</td>
										<td>{{ $currency->sign }} {{ $value->local }}</td>
										<td>{{ $currency->sign }} {{ $value->zonal }}</td>
										<td>{{ $currency->sign }} {{ $value->national }}</td>
										<td>{{ $value->updated_at }}</td>
										<td>{{ $value->created_at }}</td>
										<td></td>
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
<div class="modal fade" id="slab_modal" tabindex="-1" role="dialog" aria-labelledby="slab_modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">CREATE NEW SLAB</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="{{ route('admin.seller.post-price-slab') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-lg-4">
							<div class="left-area">
								<h5 class="heading">Slab Name *</h5>
							</div>
						</div>
						<div class="col-lg-7">
							<input type="text" class="input-field" name="slab_name" id="slab_name" placeholder="ENTER SLAB NAME" required="" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="left-area">
								<h5 class="heading">Local*</h5>
							</div>
						</div>
						<div class="col-lg-7">
							<input type="number" class="input-field" name="local_intracity" id="local_intracity" placeholder="ENTER LOCAL (INTRACITY)" required="" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="left-area">
								<h5 class="heading">Zonal*</h5>
							</div>
						</div>
						<div class="col-lg-7">
							<input type="number" class="input-field" name="zonal_intrazone" id="zonal_intrazone" placeholder="ENTER ZONAL (INTRAZONE)" required="" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="left-area">
								<h5 class="heading">National*</h5>
							</div>
						</div>
						<div class="col-lg-7">
							<input type="number" class="input-field" name="national_interzone" id="national_interzone" placeholder="ENTER NATIONAL (INTERZONE)" required="" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="left-area"></div>
						</div>
						<div class="col-lg-7">
							<input  name="submit" class="btn btn-success " type="submit">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			   <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection

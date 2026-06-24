@extends('layouts.admin') 

@section('content')

            <div class="content-area">

              <div class="add-product-content1">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible alert-alt fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Success!</strong> {{ session()->get('message')}}
                            </div>
                        @endif
                        @include('includes.admin.form-error')  
                      <form  action="{{route('admin.notification.push-notification.post')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                         <!--  <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Set Image') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="img-upload">
                                <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                  </div>
                            </div>

                          </div>
                        </div> -->


                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Message *</h4>
                             
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <textarea name="message" class="input-field" placeholder="Type message" required=""></textarea>
                           
                          </div>
                        </div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
														</div>
													</div>
													
												</div>

						    
                        <div class="row">
                          
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">Send</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection
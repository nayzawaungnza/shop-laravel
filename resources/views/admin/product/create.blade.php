@extends('admin.layouts.app')
@section('title','Create Product')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Create Product</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#productlist') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-list"></i>List
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <strong>Create Product Form</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin#productstore') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="pizzaName" placeholder="Enter Pizza Name" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName') }}" aria-required="true" aria-invalid="false">
                                    @error('pizzaName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Description</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="pizzaDescription" id="textarea-input" rows="9" placeholder="Enter Pizza Description" class="form-control @error('pizzaDescription') is-invalid @enderror"  aria-required="true" aria-invalid="false">{{ old('pizzaDescription') }}</textarea>
                                    @error('pizzaDescription')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input" name="pizzaPrice" placeholder="Enter Pizza Price" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice') }}" aria-required="true" aria-invalid="false">
                                    @error('pizzaPrice')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Size</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="productSize" id="select" class="form-control @error('productSize') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        <option value="" {{ old('productSize') == '' ? 'selected' : '' }}>Please select Size</option>
                                        <option value="9" {{ old('productSize') == '9' ? 'selected' : '' }}>Regular</option>
                                        <option value="12" {{ old('productSize') == '12' ? 'selected' : '' }}>Large</option>

                                    </select>
                                    @error('productSize')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Categories</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="productCategory" id="select" class="form-control @error('productCategory') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        <option value="" {{ old('productCategory') == '' ? 'selected' : '' }}>Please select Category</option>
                                        @foreach ( $categories as $id => $name )
                                        <option value="{{ $id }}" {{ old('productCategory') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Waiting Time</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input" name="pizzaWaitingTime" placeholder="Enter Pizza Waiting Time" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime') }}" aria-required="true" aria-invalid="false">
                                    @error('pizzaWaitingTime')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>




                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-input" class=" form-control-label">Image</label>
                                </div>
                                <div class="col-12 col-md-9">

                                    <div class="" style="width: 350px;">
                                        <div class="d-flex rounded" style="border: 1px dashed #000; background-color: rgb(233, 236, 239);">
                                          {{-- <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span> --}}

                                          <div class="image-wrap" style="width: 100%;">
                                              <div class="image-container">
                                                  <i class="fa fa-image"></i>

                                                  <img src="" alt="" srcset="" style="width: 100%;height: auto;">
                                              </div>
                                              <label for="image_input" class="camera-icon">
                                                  <i class="fa fa-camera"></i>
                                              </label>
                                              <input type="file" class="form-control @error('pizzaImage') is-invalid @enderror" name="pizzaImage" id="image_input" accept="image/*" hidden >
                                              @error('pizzaImage')
                                                  <small class="invalid-feedback">{{ $message }}</small>
                                              @enderror
                                          </div>

                                        </div>
                                      </div>


                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Publish
                            </button>
                        </form>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

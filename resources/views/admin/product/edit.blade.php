@extends('admin.layouts.app')
@section('title','Edit Product')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="history.back()"><i class="fas fa-arrow-left"></i>Back</button>
                        </div>
                    </div>
                    <div class="table-data__tool-center">
                        <div class="overview-wrap">
                            <h2 class="title-1">Edit Product</h2>
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
                        <strong>Edit Product Form</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin#productupdate',$product->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="pizzaName" placeholder="Enter Pizza Name" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$product->name) }}" aria-required="true" aria-invalid="false">
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
                                    <textarea name="pizzaDescription" id="textarea-input" rows="9" placeholder="Enter Pizza Description" class="form-control @error('pizzaDescription') is-invalid @enderror"  aria-required="true" aria-invalid="false">{{ old('pizzaDescription',$product->description) }}</textarea>
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
                                    <input type="number" id="text-input" name="pizzaPrice" placeholder="Enter Pizza Price" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$product->price) }}" aria-required="true" aria-invalid="false">
                                    @error('pizzaPrice')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Categories</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="category" id="select" class="form-control @error('category') is-invalid @enderror">
                                        <option value="-1" {{ (old('category', $product->category_id) == '-1') ? 'selected' : '' }}>Select Category</option>
                                        @foreach ($categories as $category)
                                          <option value="{{ $category->id }}" {{ (old('category', $product->category_id) == $category->id) ? 'selected' : (($product->category_id == null && $loop->first) ? 'selected' : '') }}>
                                            {{ $category->name }}
                                          </option>
                                        @endforeach
                                      </select>

                                    @error('category')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Waiting Time</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input" name="pizzaWaitingTime" placeholder="Enter Pizza Waiting Time" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$product->waiting_time) }}" aria-required="true" aria-invalid="false">
                                    @error('pizzaWaitingTime')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">View Count</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="pizzaViewCount" placeholder="Enter Pizza View Count" class="form-control @error('pizzaViewCount') is-invalid @enderror" value="{{ old('pizzaViewCount',$product->view_count) }}" aria-required="true" aria-invalid="false" readonly>
                                    @error('pizzaViewCount')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Created</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="pizzaCreated" placeholder="Enter Pizza Created " class="form-control @error('pizzaCreated') is-invalid @enderror" value="{{ old('pizzaCreated',$product->created_at) }}" aria-required="true" aria-invalid="false" readonly>
                                    @error('pizzaCreated')
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
                                                  @if ($product->image)
                                                  <img src="{{ asset('storage/'.$product->image) }}" alt="" srcset="" style="width: 100%;height: auto;">
                                                  @else
                                                  <img src="" alt="" srcset="" style="width: 100%;height: auto;">
                                                  @endif


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

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Status</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="pizzaStatus" id="select" class="form-control @error('pizzaStatus') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        <option value="" {{ old('pizzaStatus',$product->status) == ''  ? 'selected' : '' }}>Change Status</option>
                                        <option value="0" class="status--process" {{ old('pizzaStatus',$product->status) == '0'  ? 'selected' : '' }}> <span class="status--process">Active</span></option>
                                        <option value="1" class="status--denied" {{ old('pizzaStatus',$product->status) == '1'  ? 'selected' : '' }}> <span class="status--denied">Inctive</span></option>

                                    </select>
                                    @error('pizzaStatus')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Update
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

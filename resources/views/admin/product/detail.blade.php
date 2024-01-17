@extends('admin.layouts.app')
@section('title','Detail Product')
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
                            <h2 class="title-1">{{ $product->name }}</h2>
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
                        <strong>Detail Product</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="container">
                            <div class="col-lg-12 border p-3 main-section bg-white">

                                <div class="row m-0">
                                    <div class="col-lg-4 left-side-product-box pb-3">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" srcset="" style="" class="border p-3">
                                        @else
                                            <img src="" alt="" srcset="" class="border p-3">
                                        @endif


                                        <a href="{{ route('admin#productedit',$product->id) }}" class="btn btn-primary btn-sm btn-block mt-2 text-center" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i> Edit Product
                                        </a>

                                    </div>
                                    <div class="col-lg-8">
                                        <div class="right-side-pro-detail border p-3 m-0">
                                            <div class="row">

                                                <div class="table-responsive table-data">
                                                    <table class="table ">
                                                        <tbody>
                                                            <tr>
                                                                <td class="table-data__info">Name</td>
                                                                <td>{{ $product->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Category</td>
                                                                <td>{{ $product->category_id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Description</td>
                                                                <td>{{ $product->description }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Waiting Time</td>
                                                                <td><i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                    {{  $product->waiting_time }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">View Count</td>
                                                                <td><i class="zmdi zmdi-eye"></i> {{  $product->view_count }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Price</td>
                                                                <td>MMK {{ $product->price }}</td>
                                                            </tr>
                                                            {{-- <tr>
                                                                <td class="table-data__info">Size</td>
                                                            </tr> --}}
                                                            <tr>
                                                                <td class="table-data__info">Status</td>
                                                                <td>
                                                                    @if ($product->status == 0)
                                                                        <span class="status--process">Active</span>
                                                                    @elseif($product->status == 1)
                                                                        <span class="status--denied">Inactive</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Created</td>
                                                                <td>{{ $product->created_at->format('j-F-Y H:m:s') }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                                {{-- <div class="col-lg-12">
                                                    <span>Who What Wear</span>
                                                    <p class="m-0 p-0">Women's Velvet Dress</p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <p class="m-0 p-0 price-pro">$30</p>
                                                    <hr class="p-0 m-0">
                                                </div>
                                                <div class="col-lg-12 pt-2">
                                                    <h5>Product Detail</h5>
                                                    <span>{{ $product->description }}</span>
                                                    <hr class="m-0 pt-2 mt-2">
                                                </div>
                                                <div class="col-lg-12">
                                                    <p class="tag-section"><strong>Tag : </strong><a href="">Woman</a><a href="">,Man</a></p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h6>Quantity :</h6>
                                                    <input type="number" class="form-control text-center w-100" value="1">
                                                </div>
                                                <div class="col-lg-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-lg-6 pb-2">
                                                            <a href="#" class="btn btn-danger w-100">Add To Cart</a>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a href="#" class="btn btn-success w-100">Shop Now</a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

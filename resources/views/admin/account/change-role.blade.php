@extends('admin.layouts.app')
@section('title','Change Role')
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
                            <h2 class="title-1">{{ $admin->name }}</h2>
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

                                        @if ($admin->image)
                                            <img src="{{ asset('storage/'.$admin->image) }}" alt="{{ $admin->name }}" srcset="" style="" class="border p-3">
                                        @else
                                            @if ($admin->gender == 'male')
                                                <img src="{{ asset('images/Mavator.png') }}" alt="{{ $admin->name }}" srcset="" class="border p-3">
                                            @elseif ($admin->gender == 'female')
                                                <img src="{{ asset('images/Favator.png') }}" alt="{{ $admin->name }}" srcset="" class="border p-3">
                                            @else
                                            <img src="{{ asset('images/avator.png') }}" alt="{{ $admin->name }}" srcset="" class="border p-3">
                                            @endif
                                        @endif

                                        <form class="form" novalidate="" action="{{ route('admin#changerolestore',$admin->id) }}" method="post">
                                            @csrf
                                            <div class="row form-group mt-3">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Role</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="selectRole" id="select" class="form-control @error('selectRole') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                                        <option value="" {{ old('selectRole',$admin->role) == ''  ? 'selected' : '' }}>Change Role</option>
                                                        <option value="admin" {{ old('selectRole',$admin->role) == 'admin'  ? 'selected' : '' }}> Admin</option>
                                                        <option value="user" {{ old('selectRole',$admin->role) == 'user'  ? 'selected' : '' }}> User</option>

                                                    </select>
                                                    @error('selectRole')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm btn-block mt-2 text-center" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i> Submit Change Role
                                            </button>
                                        </form>




                                    </div>
                                    <div class="col-lg-8">
                                        <div class="right-side-pro-detail border p-3 m-0">
                                            <div class="row">

                                                <div class="table-responsive table-data">
                                                    <table class="table ">
                                                        <tbody>
                                                            <tr>
                                                                <td class="table-data__info">Name</td>
                                                                <td>{{ $admin->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Email</td>
                                                                <td>{{ $admin->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Phone</td>
                                                                <td>{{ $admin->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Gender</td>
                                                                <td><i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                    {{  $admin->gender }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-data__info">Address</td>
                                                                <td><i class="zmdi zmdi-eye"></i> {{  $admin->address }}</td>
                                                            </tr>

                                                            <tr>
                                                                <td class="table-data__info">Created</td>
                                                                <td>{{ $admin->created_at->format('j-F-Y H:m:s') }}</td>
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

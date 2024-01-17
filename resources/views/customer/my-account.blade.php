@extends('customer.layouts.app')
@section('title','Customer Online Website')
@section('content')

{{-- <h1>User</h1>
    <h2>Role - {{ Auth::user()->role }}</h2>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" class="btn-danger" value="Logout">
    </form> --}}

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container">

        <div class="axil-dashboard-warp">
            <div class="axil-dashboard-author">
                <div class="media-1">
                    <div class="thumbnail ">
                        @if(Auth::user()->image == null)

                            @if (Auth::user()->gender == 'male')
                            <img class="shadow-sm" src="{{ asset('images/Mavator.png') }}" alt="{{ Auth::user()->name }}" />
                            @elseif(Auth::user()->gender == 'female')
                            <img class="shadow-sm" src="{{ asset('images/Favator.png') }}" alt="{{ Auth::user()->name }}" />
                            @else
                            <img class="shadow-sm" src="{{ asset('images/avator.png') }}" alt="{{ Auth::user()->name }}" />
                            @endif
                        @else
                        <img style="" class="shadow-sm" src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                        @endif
                    </div>
                    <div class="media-body">
                        <h5 class="title mb-0">Hello {{ Auth::user()->name }}</h5>
                        <span class="joining-date">eTrade Member Since {{ Auth::user()->created_at->format('j F Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-4">
                    <aside class="axil-dashboard-aside">
                        <nav class="axil-dashboard-nav">
                            <div class="nav nav-tabs" role="tablist">
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-dashboard" role="tab" aria-selected="false"><i class="fas fa-th-large"></i>Dashboard</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-orders" role="tab" aria-selected="true"><i class="fas fa-shopping-basket"></i>Orders</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-downloads" role="tab" aria-selected="false"><i class="fas fa-file-download"></i>Downloads</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-address" role="tab" aria-selected="false"><i class="fas fa-home"></i>Addresses</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-account" role="tab" aria-selected="false"><i class="fas fa-user"></i>Account Details</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#change-password" role="tab" aria-selected="false"><i class="fas fa-lock"></i>Password Change</a>
                                <a class="nav-item nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </nav>
                    </aside>
                </div>
                <div class="col-xl-9 col-md-8">
                    @if (session('success'))
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <span class="badge badge-pill badge-success">Success</span>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif

                            @if (session('message'))
                            <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                                <span class="badge badge-pill badge-warning">Message</span>
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                    @if (session('update'))
                    <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
                        <span class="badge badge-pill badge-info">Update</span>
                        {{ session('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="nav-dashboard" role="tabpanel">
                            <div class="axil-dashboard-overview">
                                <div class="welcome-text">Hello {{ Auth::user()->name }} (not <span>{{ Auth::user()->name }}?</span>
                                    <form action="{{ route('logout') }}" method="post" class="custom-logout">
                                        @csrf
                                        <input type="submit" value="Log Out">
                                    </form>
                                    )</div>
                                <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="nav-orders" role="tabpanel">
                            <div class="axil-dashboard-order">
                                @if ($orders->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <th scope="row">#{{ $order->id }}</th>
                                                        <td>{{  date('F j, Y, h:i A', strtotime($order->order_date))}}</td>
                                                        <td><span class="badges bg-{{ $order->payment_status }}">{{ $order->payment_status }}</span></td>
                                                        <td>{{ $order->total_amount }} for {{ count($order->items) }} items</td>
                                                        <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <div class="axil-dashboard-order">
                                    <p>You don't have any order</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-downloads" role="tabpanel">
                            <div class="axil-dashboard-order">
                                <p>You don't have any download</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-address" role="tabpanel">
                            <div class="axil-dashboard-address">
                                <p class="notice-text">The following addresses will be used on the checkout page by default.</p>
                                <div class="row row--30">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="address-info mb--40">
                                            <div class="addrss-header d-flex align-items-center justify-content-between">
                                                <h4 class="title mb-0">Shipping Address</h4>
                                                <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                            </div>

                                            <ul class="address-details">
                                                <li>Name: {{ Auth::user()->name }}</li>
                                                <li>Email: {{ Auth::user()->email }}</li>
                                                <li>Phone: {{ Auth::user()->phone }}</li>
                                                <li class="mt--30">

                                                </li>
                                            </ul>
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover" >
                                                <thead class="table-info">
                                                    <tr>
                                                        <th style="text-align: center;">Order Number</th>
                                                        <th style="text-align: center;">Company Name</th>
                                                        <th style="text-align: center;">Billing</th>
                                                        <th style="text-align: center;">Shipping To</th>

                                                        <th style="text-align: center;">Phone</th>
                                                        </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($orders as $key=>$order)

                                                <tr>
                                                    <td>#{{ $order->id }}</td>
                                                    <td>{{ $order->company_name }}</td>
                                                    <td>{{ $order->shipping_address }} ၊<br>
                                                        {{ $order->shipping_township->name }} ၊<br>
                                                        {{ $order->shipping_state->name }} ၊<br>
                                                        {{ $order->shipping_country->name }} ၊<br>
                                                        {{ $order->shipping_zip }}
                                                    </td>
                                                    @if ($order->different_shipping_address)
                                                        <td>{{ $order->different_shipping_address }} ၊<br>
                                                            {{ $order->different_shipping_township->name }} ၊<br>
                                                            {{ $order->different_shipping_state->name }} ၊<br>
                                                            {{ $order->different_shipping_country->name }}

                                                        </td>
                                                        <td>{{ $order->different_shipping_phone }}</td>
                                                    @else
                                                    <td>{{ $order->shipping_address }} ၊<br>
                                                        {{ $order->shipping_township->name }} ၊<br>
                                                        {{ $order->shipping_state->name }} ၊<br>
                                                        {{ $order->shipping_country->name }} ၊<br>
                                                        {{ $order->shipping_zip }}
                                                    </td>
                                                    <td>{{ Auth::user()->phone }}</td>
                                                    @endif

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
                        <div class="tab-pane fade" id="nav-account" role="tabpanel">
                            <div class="col-lg-9">
                                <div class="axil-dashboard-account">
                                    <form class="account-details-form" method="post" action="{{ route('customer#updateprofile') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 mb-5">
                                                <div class="image-wrap">
                                                    <div class="image-container">
                                                        <i class="fa fa-user"></i>
                                                        @if(Auth::user()->image == null)

                                                            @if (Auth::user()->gender == 'male')
                                                            <img src="{{ asset('images/Mavator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center " style="" />
                                                            @elseif(Auth::user()->gender == 'female')
                                                            <img src="{{ asset('images/Favator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center " style="" />
                                                            @else
                                                            <img src="{{ asset('images/avator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center " style="" />
                                                            @endif
                                                        @else
                                                        <img class="align-self-center " style="" src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                                        @endif
                                                        {{-- <img src="" alt="" srcset=""> --}}
                                                    </div>
                                                    <label for="image_input" class="camera-icon">
                                                        <i class="fa fa-camera"></i>
                                                    </label>
                                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image_input" accept="image/*" hidden >
                                                    @error('image')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                                                    @error('name')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
                                                    @error('email')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ Auth::user()->phone }}">
                                                    @error('phone')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb--40">
                                                    <label>Gender</label>
                                                    <select class="select2 form-control @error('gender') is-invalid @enderror" name="gender">
                                                        <option value="" {{ old('gender', Auth::user()->gender) == '' ? 'selected' : '' }}>Please Select</option>
                                                        <option value="male" {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                        <option value="other" {{ old('gender', Auth::user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                    @error('gender')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ Auth::user()->address }}</textarea>
                                                    @error('address')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb--0">
                                                    <input type="submit" class="axil-btn" value="Save Changes">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="change-password" role="tabpanel">
                            <div class="col-lg-9">

                                <div class="axil-dashboard-account">
                                    <form class="account-details-form" method="POST" action="{{ route('customer#passwordchangestore') }}">
                                        @csrf
                                        <div class="row">

                                            <div class="col-12">
                                                <h5 class="title">Password Change</h5>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" value="{{ old('oldPassword') }}" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                                    @error('oldPassword')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" value="{{ old('newPassword') }}" aria-required="true" aria-invalid="false" placeholder="New Password">
                                                    @error('newPassword')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm New Password</label>
                                                    <input name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" value="{{ old('confirmPassword') }}" aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                                    @error('confirmPassword')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb--0">
                                                    <input type="submit" class="axil-btn" value="Save Changes">
                                                </div>
                                            </div>
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
    <!-- Shop End -->

@endsection
@section('scriptsource')
<script>
    image_input = document.querySelector("#image_input");
        image_input.onchange = function(e){
            if(e.target.files.length>0){
                src=URL.createObjectURL(e.target.files[0]);
                image = document.querySelector(".image-container img");
                image.src= src;
            }
        }
</script>
@endsection

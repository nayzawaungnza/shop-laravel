@extends('customer.layouts.app')
@section('title', 'Product Order- Checkout ' )

@section('content')

{{-- <h1>User</h1>
    <h2>Role - {{ Auth::user()->role }}</h2>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" class="btn-danger" value="Logout">
    </form> --}}

    <!-- Breadcrumb Start -->
    <div class="container-fluid ">
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


    <!-- Cart Start -->
    <div class="container-fluid axil-checkout-page">



            @if ($carts->isNotEmpty())

            <form action="{{ route('customer#ordercreate') }}" method="POST">
                <div class="row px-xl-5">
            @csrf
            <div class="col-lg-6 ">
                <div class="axil-checkout-notice">
                    {{-- <div class="axil-toggle-box">
                        <div class="toggle-bar"><i class="fas fa-pencil"></i> Have a coupon? <a href="javascript:void(0)" class="toggle-btn">Click here to enter your code <i class="fa fa-angle-down"></i></a>
                        </div>

                        <div class="axil-checkout-coupon toggle-open" style="display: none;">
                            <p>If you have a coupon code, please apply it below.</p>
                            <div class="input-group">
                                <input placeholder="Enter coupon code" type="text">
                                <div class="apply-btn">
                                    <button type="submit" class="axil-btn btn-bg-primary">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="axil-checkout-billing">
                        <h4 class="title mb--40">Billing & Shipping</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Name <span>*</span></label>
                                    <input type="text" id="first-name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Email <span>*</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" placeholder="Enter Email">
                            @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone <span>*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ Auth::user()->phone }}" placeholder="Enter Phone e.g. 09 xxx xxx xxx">
                            @error('phone')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" id="company-name" name="companyName" class="form-control @error('companyName') is-invalid @enderror">
                            @error('companyName')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>


                         <div class="form-group">
                            <label>Country/ Region <span>*</span></label>
                            <select id="Region" name="shippingCountry" class="form-control @error('shippingCountry') is-invalid @enderror">
                                <option value="" {{ old('shippingCountry') == '' ? 'selected' : '' }}>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('shippingCountry') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('shippingCountry')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>State <span>*</span></label>
                            <select  id="shippingState" name="shippingState" class="form-control @error('shippingState') is-invalid @enderror">
                                <option value="" >Select State</option>

                            </select>
                            @error('shippingState')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Township/ City <span>*</span></label>
                            <select id="shippingTownship" name="shippingTownship" class="form-control @error('shippingTownship') is-invalid @enderror">
                                <option value="" {{ old('shippingTownship') == '' ? 'selected' : '' }}>Select Township</option>

                            </select>
                            @error('shippingTownship')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Postcode / ZIP <span>*</span></label>
                            <input type="text" id="zip" name="zip" class="form-control @error('zip') is-invalid @enderror">
                            @error('zip')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Street Address <span>*</span></label>
                            <input type="text" id="address1" name="shippingAddress" class="form-control @error('shippingAddress') is-invalid @enderror mb--15" placeholder="House number and street name" >
                            @error('shippingAddress')
                                    <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label>Country</label>
                            <input type="text" id="country">
                        </div>

                        <div class="form-group input-group">
                            <input type="checkbox" id="checkbox1" name="account-create">
                            <label for="checkbox1">Create an account</label>
                        </div> --}}
                        <div class="form-group different-shippng">
                            <div class="toggle-bar {{ old('diffrentShipping') ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="toggle-btn ">
                                    <input type="checkbox" id="checkbox2" name="diffrentShipping" {{ old('diffrentShipping') ? 'checked' : '' }}>
                                    <label for="checkbox2">Ship to a different address?</label>
                                </a>
                            </div>
                            <div class="toggle-open" style=" {{ old('diffrentShipping') ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group">
                                    <label>Country/ Region <span>*</span></label>
                                    <select id="diff-Region" name="diffrentShippingCountry" class="form-control @error('diffrentShippingCountry') is-invalid @enderror">
                                        <option value="" {{ old('diffrentShippingCountry') == ' ' ? 'selected' : '' }}>Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('diffrentShippingCountry') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('diffrentShippingCountry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>State <span>*</span></label>
                                    <select  id="diffrentShippingState" name="diffrentShippingState" class="form-control @error('diffrentShippingState') is-invalid @enderror">
                                        <option value="" >Select State</option>

                                    </select>
                                    @error('diffrentShippingState')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Township/ City <span>*</span></label>
                                    <select id="diffrentShippingTownship" name="diffrentShippingTownship" class="form-control @error('diffrentShippingTownship') is-invalid @enderror">
                                        <option value="" {{ old('diffrentShippingTownship') == '' ? 'selected' : '' }}>Select Township</option>

                                    </select>
                                    @error('diffrentShippingTownship')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label>Street Address <span>*</span></label>
                                    <input type="text" id="diff-address1" name="diffrentShippingAddress" class="form-control @error('diffrentShippingAddress') is-invalid @enderror" class="mb--15" placeholder="House number and street name">
                                    @error('diffrentShippingAddress')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Phone <span>*</span></label>
                                    <input type="tel" id="diff-phone" name="diffrentShippingPhone" class="form-control @error('diffrentShippingPhone') is-invalid @enderror">
                                    @error('diffrentShippingPhone')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Other Notes (optional)</label>
                            <textarea id="notes" name="order_note" rows="2" placeholder="Notes about your order, e.g. speacial notes for delivery."></textarea>
                        </div>
                    </div>


                </div>

            </div>


            <div class="col-lg-6">

                <div class="axil-order-summery order-checkout-summery">
                    <h5 class="title mb--20">Your Order</h5>
                    <div class="summery-table-wrap">
                        <table class="table summery-table">
                            <thead>
                                <tr>

                                    <th>Product</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                <tr class="order-product">

                                    <td>{{ $cart->name }} <span class="quantity">x {{ $cart->quantity }}</span></td>
                                    <td>{{ number_format($cart->total,2)  }} MMK</td>
                                </tr>
                                @endforeach

                                <tr class="order-subtotal">
                                    <td>Subtotal</td>
                                    <td>{{ number_format($subtotal,2) }} MMK</td>
                                </tr>

                                {{-- <tr class="order-shipping">
                                    <td colspan="2">
                                        <div class="shipping-amount">
                                            <span class="title">Shipping Method</span>
                                            <span class="amount">{{ number_format($shipping, 2) }} MMK</span>
                                        </div>
                                        <div class="input-group">
                                            <input type="radio" id="radio1" name="shipping" checked="">
                                            <label for="radio1">Free Shippping</label>
                                        </div>
                                        <div class="input-group">
                                            <input type="radio" id="radio2" name="shipping">
                                            <label for="radio2">Local</label>
                                        </div>
                                        <div class="input-group">
                                            <input type="radio" id="radio3" name="shipping">
                                            <label for="radio3">Flat rate</label>
                                        </div>
                                    </td>
                                </tr> --}}
                                <tr class="order-total">
                                    <td>Total</td>
                                    <td class="order-total-amount">{{ number_format($total,2) }} MMK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="order-payment-method">
                        <div class="single-payment">
                            <div class="input-group">
                                <input type="radio" id="radio4" name="payment" value="direct_bank_transfer">
                                <label for="radio4">Direct bank transfer</label>
                            </div>
                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                        </div>
                        <div class="single-payment">
                            <div class="input-group">
                                <input type="radio" id="radio5" name="payment" value="cash_on_delivery">
                                <label for="radio5">Cash on delivery</label>
                            </div>
                            <p>Pay with cash upon delivery.</p>
                        </div>

                    </div>
                    <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Place Order</button>
                </div>

            </div>
        </div>
        </form>
            @else
            <div class="row px-xl-5">
            <div class="col-md-12 col-sm-12">
		        Checkout is not available whilst your cart is empty.
            </div>
            </div>
            @endif




    </div>
    <!-- Cart End -->


@endsection

@section('scriptsource')
<script>
    $(document).ready(function(){
        $('#Region').change(function(){
            var country_id = $(this).val();
            if(country_id){
                $.ajax({
                   type:"GET",
                   url:"{{url('get-states')}}?country_id="+country_id,
                   success:function(res){
                       if(res){
                        console.log(res);
                           $("#shippingState").empty();
                           $("#shippingState").append('<option>Select State</option>');
                           $.each(res,function(key,value){
                               $("#shippingState").append('<option value="'+key+'">'+value+'</option>');
                           });
                       }else{
                           $("#shippingState").empty();
                       }
                   }
                });
            }else{
                $("shippingState").empty();
                $("#shippingTownship").empty();
            }
        });
    });

    $(document).ready(function() {
    // Listen to onchange event of state dropdown field
    $('#shippingState').on('change', function() {
        var stateId = $(this).val();
        if (stateId) {
            // Send Ajax request to fetch townships for the selected state
            $.ajax({
                url: '/get-townships/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear and populate the township dropdown field with fetched data
                    $('#shippingTownship').html('');
                    $('#shippingTownship').append('<option value="">Select a Township</option>');
                    $.each(data, function(key, value) {
                        $('#shippingTownship').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            // Clear the shippingTownship dropdown field if no state is selected
            $('#shippingTownship').html('');
            $('#shippingTownship').append('<option value="">Select a township</option>');
        }
    });
});

$(document).ready(function(){
        $('#diff-Region').change(function(){
            var country_id = $(this).val();
            if(country_id){
                $.ajax({
                   type:"GET",
                   url:"{{url('get-states')}}?country_id="+country_id,
                   success:function(res){
                       if(res){
                        console.log(res);
                           $("#diffrentShippingState").empty();
                           $("#diffrentShippingState").append('<option>Select State</option>');
                           $.each(res,function(key,value){
                               $("#diffrentShippingState").append('<option value="'+key+'">'+value+'</option>');
                           });
                       }else{
                           $("#diffrentShippingState").empty();
                       }
                   }
                });
            }else{
                $("diffrentShippingState").empty();
                $("#diffrentShippingTownship").empty();
            }
        });
    });

    $(document).ready(function() {
    // Listen to onchange event of state dropdown field
    $('#diffrentShippingState').on('change', function() {
        var stateId = $(this).val();
        if (stateId) {
            // Send Ajax request to fetch townships for the selected state
            $.ajax({
                url: '/get-townships/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear and populate the township dropdown field with fetched data
                    $('#diffrentShippingTownship').html('');
                    $('#diffrentShippingTownship').append('<option value="">Select a Township</option>');
                    $.each(data, function(key, value) {
                        $('#diffrentShippingTownship').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            // Clear the diffrentShippingTownship dropdown field if no state is selected
            $('#diffrentShippingTownship').html('');
            $('#diffrentShippingTownship').append('<option value="">Select a township</option>');
        }
    });
});


</script>

@endsection

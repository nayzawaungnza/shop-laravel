@extends('customer.layouts.app')
@section('title', 'Product - Cart' )

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


    <!-- Cart Start -->
    <div class="container-fluid">
        @if ($carts->isNotEmpty())

        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        @foreach($carts as $cart)

                            <tr data-id="{{ $cart->product_id }}" id="item-{{ $cart->id }}" >
                                <td class="align-middle">
                                    <img src="{{ asset('storage/'.$cart->image) }}" alt="{{ $cart->name }}" style="width: 50px;">
                                </td>
                                <td class="align-middle">

                                    {{ $cart->name }}
                                </td>
                                <td class="align-middle item-price" data-price="{{ $cart->price }}">{{  number_format($cart->price,0) }} MMK</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus decrement-qty" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"  class="item-qty form-control form-control-sm bg-secondary border-0 text-center" value="{{ $cart->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus increment-qty" >
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle item-total">{{ number_format($cart->total,0)  }} MMK</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger remove-item" data-id="{{ $cart->id }}"><i class="fa fa-times"></i></button></td>
                            </tr>


                        @endforeach



                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 class="cart-subtotal">
                                {{ number_format($subtotal) }} MMK
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium cart-tax">{{ number_format($tax) }} MMK</h6>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">{{ number_format($shipping) }} MMK</h6>
                        </div> --}}
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class="cart-total">{{ number_format($total) }} MMK</h5>
                        </div>
                        <a href="{{ route('customer#checkout') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>

        </div>

        @else

        <div class="row px-xl-5">
            <div class="col-md-12 col-sm-12">
                Your cart is currently empty.
            </div>
        </div>

        @endif
    </div>
    <!-- Cart End -->


@endsection

@section('scriptsource')
<script>


$(document).ready(function(){

        function formatNumberWithCommas(number) {
                    const parts = number.toString().split('.');
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    return parts.join('.');
        }

        // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();

        var $price = $(this).parents('tr').find('.item-price');
        var $total = $(this).parents('tr').find('.item-total');

        var price = parseInt($price.data('price'));

        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;

            updateCart($(this).closest('tr').data('id'),  newVal );
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                updateCart($(this).closest('tr').data('id'),  newVal );
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);

        // Calculate the new total amount for the item
        var total = newVal * price;

        // Update the HTML of the item total element with the new total amount
        $total.text( formatNumberWithCommas(total) + ' MMK');

        console.log(newVal);
    });



    // Update cart with new quantity
    function updateCart(id, qty) {
        console.log(id, qty);
        $.ajax({
            url: "{{ route('ajax#cartupdate') }}",
            method: 'POST',
            data: {
                id: id,
                qty: qty,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                // Update cart subtotal and total
                $('.cart-subtotal').html(formatNumberWithCommas(response.subtotal) + ' MMK');
                $('.cart-tax').html(formatNumberWithCommas(response.tax) + ' MMK');
                $('.cart-total').html(formatNumberWithCommas(response.total) + ' MMK');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    //remove item from cart
    // Attach a click event listener to the "Remove" button
$('.remove-item').click(function(e) {
    e.preventDefault();

    var  cartId = $(this).data('id'); //in button
    var  productId = $(this).closest('tr').data('id');
    console.log('cart id');
    console.log(cartId);
    console.log('product id');
    console.log(productId);


    //Send an AJAX request to the server
    $.ajax({
        url: '{{ route("ajax#cartremove") }}',
        type: 'POST',
        data: {
            cartid : cartId,
            productid: productId,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(response) {
            // Update the cart UI with the new subtotal, tax, and total


                $('.cart-subtotal').html(formatNumberWithCommas(response.subtotal) + ' MMK');
                $('.cart-tax').html(formatNumberWithCommas(response.tax) + ' MMK');
                $('.cart-total').html(formatNumberWithCommas(response.total) + ' MMK');
                //$('.cart-count').html(cartcount);

            // Remove the item from the cart UI
            $('#item-' + cartId).remove();

            // Show a success message
            alert(response.success);
        },
        error: function(xhr, status, error) {
            // Show an error message
            alert(xhr.responseText);
        }
    });
});

});


</script>
@endsection

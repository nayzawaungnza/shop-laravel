@extends('customer.layouts.app')
@section('title', 'Product Order- Checkout Success' )

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
        <div class="row px-xl-5">
            <div class="col-md-12">
                <h1>Order Confirmation</h1>
<p>Thank you for your order!</p>
<p>Your order ID is: {{ $orderid }}</p>
<p>Estimated delivery date: </p>

            </div>
        </div>







    </div>
    <!-- Cart End -->


@endsection

@section('scriptsource')
<script>


$(document).ready(function(){

//         function formatNumberWithCommas(number) {
//                     const parts = number.toString().split('.');
//                     parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
//                     return parts.join('.');
//         }

//         // Product Quantity
//     $('.quantity button').on('click', function () {
//         var button = $(this);
//         var oldValue = button.parent().parent().find('input').val();

//         var $price = $(this).parents('tr').find('.item-price');
//         var $total = $(this).parents('tr').find('.item-total');

//         var price = parseInt($price.data('price'));

//         if (button.hasClass('btn-plus')) {
//             var newVal = parseFloat(oldValue) + 1;

//             updateCart($(this).closest('tr').data('id'),  newVal );
//         } else {
//             if (oldValue > 0) {
//                 var newVal = parseFloat(oldValue) - 1;
//                 updateCart($(this).closest('tr').data('id'),  newVal );
//             } else {
//                 newVal = 0;
//             }
//         }
//         button.parent().parent().find('input').val(newVal);

//         // Calculate the new total amount for the item
//         var total = newVal * price;

//         // Update the HTML of the item total element with the new total amount
//         $total.text( formatNumberWithCommas(total) + ' MMK');

//         console.log(newVal);
//     });



//     // Update cart with new quantity
//     function updateCart(id, qty) {
//         console.log(id, qty);
//         $.ajax({
//             url: "{{ route('ajax#cartupdate') }}",
//             method: 'POST',
//             data: {
//                 id: id,
//                 qty: qty,
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function(response) {
//                 console.log(response);
//                 // Update cart subtotal and total
//                 $('.cart-subtotal').html(formatNumberWithCommas(response.subtotal) + ' MMK');
//                 $('.cart-tax').html(formatNumberWithCommas(response.tax) + ' MMK');
//                 $('.cart-total').html(formatNumberWithCommas(response.total) + ' MMK');
//             },
//             error: function(xhr, status, error) {
//                 console.log(xhr.responseText);
//             }
//         });
//     }

//     //remove item from cart
//     // Attach a click event listener to the "Remove" button
// $('.remove-item').click(function(e) {
//     e.preventDefault();

//     var  cartId = $(this).data('id'); //in button
//     var  productId = $(this).closest('tr').data('id');
//     console.log('cart id');
//     console.log(cartId);
//     console.log('product id');
//     console.log(productId);


//     //Send an AJAX request to the server
//     $.ajax({
//         url: '{{ route("ajax#cartremove") }}',
//         type: 'POST',
//         data: {
//             cartid : cartId,
//             productid: productId,
//             _token: '{{ csrf_token() }}'
//         },
//         dataType: 'json',
//         success: function(response) {
//             // Update the cart UI with the new subtotal, tax, and total


//                 $('.cart-subtotal').html(formatNumberWithCommas(response.subtotal) + ' MMK');
//                 $('.cart-tax').html(formatNumberWithCommas(response.tax) + ' MMK');
//                 $('.cart-total').html(formatNumberWithCommas(response.total) + ' MMK');
//                 //$('.cart-count').html(cartcount);

//             // Remove the item from the cart UI
//             $('#item-' + cartId).remove();

//             // Show a success message
//             alert(response.success);
//         },
//         error: function(xhr, status, error) {
//             // Show an error message
//             alert(xhr.responseText);
//         }
//     });
// });

});


</script>
@endsection

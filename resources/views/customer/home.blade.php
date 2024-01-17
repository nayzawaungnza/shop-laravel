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
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <select class="form-control" id="sortingProducts">
                                    <option value="">Sorting</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                                {{-- <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Ascending</a>
                                        <a class="dropdown-item" href="#">Descending</a>
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div> --}}
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @if ($products->isNotEmpty())
                    <div class="row" id="productList">
                        @foreach ($products as $product )

                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    @if($product->image == null)
                                    <img class="img-fluid w-100" style="" src="{{ asset('images/no-photos.png') }}" alt="{{ $product->name }}">
                                    @else
                                        <img class="img-fluid w-100" style="" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                    @endif


                                    <div class="product-action">

                                        @if (Auth::check())
                                            <input type="hidden" id="qty" value="1">
                                            <button class="btn btn-outline-dark btn-square add-to-cart-btn" id="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></button>
                                        @endif
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>

                                        <button class="btn btn-outline-dark btn-square"  ><i class="fa fa-sync-alt"></i></button>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('customer#productdetail', $product->slug) }}"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="{{ route('customer#productdetail', $product->slug) }}">{{ $product->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><span id="price">{{ number_format($product->price,0) }}</span> MMK</h5>
                                        {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        @php
                                            // Calculate the average rating
                                            $averageRating = $product->reviews->avg('rating');
                                            // Convert the average rating to a visual representation
                                            $fullStars = floor($averageRating);
                                            $halfStar = ($averageRating - $fullStars) >= 0.5;
                                        @endphp

                                        <!-- Display the average rating as stars with Font Awesome icons -->
                                        <div>
                                            @for($i = 0; $i < $fullStars; $i++)
                                                <span class="rating-active">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @endfor

                                            @if($halfStar)
                                                <span class="rating-active">
                                                    <i class="fas fa-star-half-alt"></i>
                                                </span>
                                            @endif
                                            @php
                                                $roundedRating = $halfStar >= 0.5 ? floor( 5 - $averageRating) : 5-$fullStars ;

                                            @endphp


                                            @for($i = 1; $i <= $roundedRating; $i++)
                                                <span class="rating-inactive">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @endfor
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    @else
                    <div class="alert alert-danger" role="alert">
                        There is no product here!
                    </div>
                    @endif



                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('scriptsource')
<script>
// (function ($) {
//     "use strict";

    $(document).ready(function(){
        // $.ajax({
        //     type:'get',
        //     url:'http://127.0.0.1:8000/ajax/products',
        //     dataType:'json',
        //     success: function(response){ //response as get data from url
        //         console.log(response);

        //     }
        // })

        $(document).on('click', '.add-to-cart-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var qty = $('#qty').val();
    console.log(id);
    console.log(qty);
    $.ajax({
        type: "POST",
        url: "{{ route('ajax#cartadd') }}",
        data: {
            id: id,
            qty: qty,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log(response);
        }
    });
});

        function formatNumberWithCommas(number) {
                    const parts = number.toString().split('.');
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    return parts.join('.');
        }

        $('#sortingProducts').change(function(){
            var sortoption = $('#sortingProducts').val();

            if(sortoption == 'desc'){
                    $.ajax({
                        type:"get",
                        url:"{{ route('ajax#productslist') }}",
                        data: {'status':'desc'},
                        dataType:"json",
                        success: function(response){ //response as get data from url
                            //console.log(response);
                            var list= '';
                            for(var i = 0; i < response.length; i++)
                            {
                                list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">

                                        <img class="img-fluid w-100 " style="" src="${ response[i].image ? '/storage/' + response[i].image : '/images/no-photos.png' } " alt="${ response[i].name }">

                                    <div class="product-action">
                                        @if (Auth::check())
                                        <input type="hidden" id="qty" value="1">
                                        <button class="btn btn-outline-dark btn-square add-to-cart-btn" id="add-to-cart-btn" data-id="${response[i].id}"><i class="fa fa-shopping-cart"></i></button>
                                        @endif
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="/product/${response[i].slug}"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="/product/${response[i].slug}">${ response[i].name }</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><span id="price">${ formatNumberWithCommas(response[i].price) }</span> MMK</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                                `;
                                console.log(list);
                            }
                            $('#productList').html(list);

                        }
                    })

            }
            else if(sortoption == 'asc'){
                    $.ajax({
                        type:"get",
                        url:"{{ route('ajax#productslist') }}",
                        data: {'status':'asc'},
                        dataType:"json",
                        success: function(response){ //response as get data from url
                            var list= '';
                            for(var i = 0; i < response.length; i++)
                            {
                                list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">

                                        <img class="img-fluid w-100 2" style="" src="${ response[i].image ? '/storage/' + response[i].image : '/images/no-photos.png' } " alt="${ response[i].name }">

                                    <div class="product-action">
                                        @if (Auth::check())
                                        <input type="hidden" id="qty" value="1">
                                        <button class="btn btn-outline-dark btn-square add-to-cart-btn" id="add-to-cart-btn" data-id="${response[i].id}"><i class="fa fa-shopping-cart"></i></button>
                                        @endif
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="/product/${response[i].slug}"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="/product/${response[i].slug}">${ response[i].name }</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><span id="price">${ formatNumberWithCommas(response[i].price) }</span> MMK</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                                `;
                                //console.log(list);
                            }
                            $('#productList').html(list);

                        }
                    })

            }
        });

    });


// })(jQuery);
</script>

@endsection

@extends('customer.layouts.app')
@section('title', 'Product - ' . $product->name)
@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

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


    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <button class="btn btn-primary px-3 my-3" onclick="history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</button>
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class=" mr-2">
                            @php
                                // Calculate the average rating
                                $averageRating = $reviews->avg('rating');
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

                            <!-- Display the average rating in numeric form -->
                            @if ($averageRating)
                            <span>({{ $averageRating }}/5)</span>
                            @else

                            @endif

                        </div>


                        </div>
                        <small class="pt-1"><i class="fas fa-eye mr-2"> {{ $product->view_count }}</i></small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4" ><span id="price">{{ number_format($product->price,0)  }}</span> MMK</h3>
                    <p class="mb-4">{{ $product->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="qty" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        @if (Auth::check())
                            <button class="btn btn-primary px-3 add-to-cart-btn" id="add-to-cart-btn"  data-id="{{ $product->id }}"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                        @endif
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    <div class="custom-reviews">

                        @auth



                        @if ($order && $existingReview && $order->count() !== $existingReview->count())
                            <form method="POST" action="{{ route('customer#storeReview',  $product->id ) }}">
                                @csrf
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>

                                        <div class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                        </div>


                                </div>

                                <div class="form-group">
                                    <label for="feedback">Write your feedback *</label>
                                    <textarea id="feedback" name="review" cols="20" rows="3" class="form-control @error('review') is-invalid @enderror"></textarea>
                                    @error('review')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        @else
                            <p>You can only review products you have purchased.</p>
                        @endif

                        @endauth


                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                @if (session('success'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                @if (session('delete'))
                <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                    <span class="badge badge-pill badge-warning">Delete</span>
                    {{ session('delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                @if (session('error'))
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Error</span>
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Comments ({{ $comments->count() }})</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Reviews ({{ $reviews->count() }})</a>

                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade " id="tab-pane-4">
                            <h4 class="mb-4">{{ $reviews->count() }} review for "{{ $product->name }}"</h4>
                            @foreach ($reviews as $review)

                                        <div class="media comment-view mb-4">
                                            @if ($review->customer->image)
                                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'. $review->customer->image))) }}"  alt="{{ $review->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            @else
                                                @if ($review->customer->gender == 'male')
                                                    <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Mavator.png'))) }}"  alt="{{ $review->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                @elseif ($review->customer->gender == 'female')
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Favator.png'))) }}"  alt="{{ $review->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                @else
                                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/avator.png'))) }}" alt="{{ $review->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                @endif
                                            @endif


                                            <div class="media-body">
                                                <h6>{{ $review->customer->name }}<small> - <i>{{  date('F j, Y', strtotime($review->created_at))}}</i></small></h6>


                                                <div class="d-flex  mb-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <span class="rating-active">
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                        @else
                                                            <span class="rating-inactive">
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                        @endif
                                                    @endfor

                                                </div>

                                                <p>{{ $review->comment }}</p>

                                                <hr>




                                            </div>


                                        </div>


                                    @endforeach
                        </div>
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            {{ $product->description }}
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">{{ $comments->count() }} comment for "{{ $product->name }}"</h4>

                                    @foreach ($comments as $comment)

                                        <div class="media comment-view mb-4">
                                            @if ($comment->customer->image)
                                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'. $comment->customer->image))) }}"  alt="{{ $comment->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            @else
                                                @if ($comment->customer->gender == 'male')
                                                    <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Mavator.png'))) }}"  alt="{{ $comment->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                @elseif ($comment->customer->gender == 'female')
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Favator.png'))) }}"  alt="{{ $comment->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                @else
                                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/avator.png'))) }}" alt="{{ $comment->customer->name }}" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                @endif
                                            @endif


                                            <div class="media-body">
                                                <h6>{{ $comment->customer->name }}<small> - <i>{{  date('F j, Y', strtotime($comment->created_at))}}</i></small></h6>
                                                <p>{{ $comment->comment }}</p>

                                                <hr>
                                                <div class="action-comment">
                                                    @if(auth()->user() && $comment->customer_id == auth()->user()->id)
                                                        <form action="{{ route('customer#comments.destroy', $comment->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-btn btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    @endif
                                                    {{-- <span class="message"></span> --}}
                                                    @guest
                                                        <span class="like-count" data-comment-id="{{ $comment->id }}">{{ $comment->like_count }} Likes</span>
                                                    @endguest
                                                    @auth
                                                    <button class="like-button{{ (auth()->check() && $comment->likes->contains('customer_id', auth()->user()->id) && $comment->likes->contains('comment_id', $comment->id)) ? ' liked' : '' }}" data-comment-id="{{ $comment->id }}">
                                                        <span id="icon"><i class="far fa-thumbs-up"></i></span>
                                                        <span id="likes-count-{{ $comment->id }}">{{ $comment->like_count }}</span> Like
                                                    </button>

                                                    <button class="reply-button">Reply</button>

                                                        <!-- Reply form (hidden by default) -->
                                                    <div class="reply-form" style="display: none;">
                                                        <form action="{{ route('customer#reply-comments.store',['productId' => $comment->product_id, 'commentId' => $comment->id]) }}" method="POST">
                                                            @csrf
                                                            <!-- Add form fields for reply content, user ID, parent comment ID, etc. -->
                                                            <div class="form-group">
                                                                <textarea name="reply_content" class="form-control @error('reply_content') is-invalid @enderror"></textarea>
                                                                @error('reply_content')
                                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                                                            {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}"> --}}
                                                            <div class="form-group">
                                                                <button class="btn btn-primary px-3" type="submit">Reply Comment</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    @endauth


                                                </div>

                                                <!-- Show replies -->
                                            @if ($comment->replies->isNotEmpty())
                                            <div class="replies">
                                                @foreach($comment->replies as $reply)

                                                    <p>Replied By: {{ $reply->customer->name }}</p>

                                                    <h6>{{ $reply->customer->name }}<small> - <i>{{  date('F j, Y', strtotime($reply->created_at))}}</i></small></h6>
                                                <p>{{ $reply->comment }}</p>

                                                <hr>
                                                <div class="action-comment">
                                                    @if(auth()->user() && $reply->customer_id == auth()->user()->id)
                                                        <form action="{{ route('customer#comments.destroy', $reply->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-btn btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    @endif
                                                    {{-- <span class="message"></span> --}}
                                                    @guest
                                                        <span class="like-count" data-comment-id="{{ $reply->id }}">{{ $reply->like_count }} Likes</span>
                                                    @endguest
                                                    @auth
                                                    <button class="like-button{{ (auth()->check() && $reply->likes->contains('customer_id', auth()->user()->id) && $reply->likes->contains('comment_id', $reply->id)) ? ' liked' : '' }}" data-comment-id="{{ $reply->id }}">
                                                        <span id="icon"><i class="far fa-thumbs-up"></i></span>
                                                        <span id="likes-count-{{ $reply->id }}">{{ $reply->like_count }}</span> Like
                                                    </button>

                                                    {{-- <button class="reply-button">Reply</button> --}}

                                                        <!-- Reply form (hidden by default) -->
                                                    {{-- <div class="reply-form" style="display: none;">
                                                        <form action="{{ route('customer#reply-comments.store',['productId' => $reply->product_id, 'commentId' => $reply->id]) }}" method="POST">
                                                            @csrf
                                                            <!-- Add form fields for reply content, user ID, parent comment ID, etc. -->
                                                            <div class="form-group">
                                                                <textarea name="reply_content" class="form-control @error('reply_content') is-invalid @enderror"></textarea>
                                                                @error('reply_content')
                                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                                                            {{-- <input type="hidden" name="parent_id" value="{{ $reply->id }}"> --}}
                                                            {{-- <div class="form-group">
                                                                <button class="btn btn-primary px-3" type="submit">Reply Comment</button>
                                                            </div>

                                                        </form>
                                                    </div> --}}

                                                    @endauth


                                                </div>
                                                @endforeach
                                            </div>
                                        @endif



                                            </div>


                                        </div>


                                    @endforeach

                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a Comment</h4>
                                    {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        <small>{{ $error }}</small>
                                        @endforeach
                                    </div>
                                    @endif --}}
                                    <form method="POST" action="{{ route('customer#storeComment',  $product->id ) }}">
                                        @csrf
                                        {{-- <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Your Rating * :</p>

                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                                </div>


                                        </div> --}}

                                        <div class="form-group">
                                            <label for="message">Your Comment *</label>
                                            <textarea id="message" name="comment" cols="30" rows="5" class="form-control @error('comment') is-invalid @enderror"></textarea>
                                            @error('comment')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Comment" class="btn btn-primary px-3">
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

   <!-- Products Start -->
   <div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($products as $product )
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ route('customer#productdetail',$product->slug) }}"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="{{ route('customer#productdetail',$product->slug) }}">{{ $product->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5 ><span id="price">{{ number_format($product->price,0) }}</span> MMK</h5><h6 class="text-muted ml-2"></h6>
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
                            <small><i class="fas fa-eye"></i> {{ $product->view_count }}</small>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</div>
<!-- Products End -->
@endsection

@section('scriptsource')
<script>
    $(document).ready(function() {
        // Attach click event listener to each reply button
        $('.reply-button').click(function() {
            // Find the corresponding reply form
            var replyForm = $(this).next('.reply-form');

            // Toggle the display of the reply form
            replyForm.toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
      // Get the rating input element
      var ratingInput = $('input[name="rating"]:checked');

      // Add change event listener to the rating input
      $('input[name="rating"]').change(function() {
        ratingInput = $(this);
        var selectedRating = ratingInput.val();
        console.log(selectedRating); // Output the selected rating value
      });
    });
  </script>

<script>
    $(document).ready(function() {
        $('.like-button').click(function(e) {
            e.preventDefault();

            var commentId = $(this).data('comment-id');
            var url = '/comments/' + commentId + '/like';

            // Check if the button is currently in a "liked" state
            var isLiked = $(this).hasClass('liked');

            // Determine the appropriate AJAX request type based on the button state
            var requestType = isLiked ? 'DELETE' : 'POST';

            $.ajax({
                type: requestType,
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    commentId : commentId,
                    customerId: {{ auth()->id() }},
                },
                success: function(response) {
                    // Toggle the "liked" class on the button
                    $('.like-button[data-comment-id="' + commentId + '"]').toggleClass('liked');

                    // Update the like count dynamically
                    $('#likes-count-' + commentId).text(response.likeCount);
                    //$('#likes-count-' + commentId).text(response.likeCount);
                    $('.like-count[data-comment-id="' + commentId + '"]').text(response.likeCount);

                    // Display a success message
                    $('.message').text(response.message);

                    console.log(response.likeCount);
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    $('.message').text(xhr.responseJSON.message);
                }
            });
        });
    });
</script>



<script>


$(document).ready(function(){

    $(document).on('click', '.add-to-cart-btn', function(e) {
    // e.preventDefault();
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


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
        console.log(newVal);
    });

//  $(document).on('click', '.add-to-cart-btn', function(e) {
//     e.preventDefault();
//     var id = $(this).data('id');
//     var qty = $('#qty').val();
//     console.log(id);
//     console.log(qty);
//     $.ajax({
//         type: "POST",
//         url: "{{ route('ajax#cartadd') }}",
//         data: {
//             id: id,
//             qty: qty,
//             _token: '{{ csrf_token() }}'
//         },
//         success: function(response) {

//             $('.cart-count').html(cartcount);
//             console.log(response);
//         }
//     });
// });

 });
</script>
@endsection

@extends('admin.layouts.app')
@section('title','Reviews List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Reviews List</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        {{-- <a href="#">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Product
                            </button>
                        </a> --}}
                        {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button> --}}

                    </div>
                </div>

                @if (session('create'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Create</span>
                    {{ session('create') }}
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

                @if (session('update'))
                <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
                    <span class="badge badge-pill badge-info">Update</span>
                    {{ session('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif





                @if ($reviews->isNotEmpty())

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Rating</th>
                                <th>Comments</th>
                                <th>Username</th>
                                <th>Products</th>
                                <th>Date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($reviews as $review )

                            <tr class="tr-shadow">

                                <td class="w-25">
                                    <div class=" mr-2">
                                        @php
                                            // Calculate the average rating
                                            $averageRating = $review->avg('rating');
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
                                        <span>({{ $averageRating }}/5)</span>
                                    </div>
                                </td>
                                <td>
                                                @if ($review->comment == null || $review->comment == '')
                                                <p>No comments for this review</p>

                                                @else
                                                <p>{{ $review->comment }}</p>
                                                @endif
                                </td>
                                <td>{{ $review->customer->name }}</td>
                                {{-- <td>{{ Str::limit($product->description, 30, '[...]') }}</td> --}}
                                <td></td>
                                <td>{{  date('F j, Y', strtotime($review->created_at))}}</td>


                                <td>

                                </td>
                            </tr>
                            <tr class="spacer"></tr>

                            @endforeach


                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $reviews->links() }}

                        {{-- {{ $products->appends(request()->query())->links() }} --}}
                    </div>
                </div>

                @else
                <div class="alert alert-danger" role="alert">
                    There is no reviews here!
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

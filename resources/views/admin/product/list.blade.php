@extends('admin.layouts.app')
@section('title','Products List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#productcreate') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>

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

                <div class="row">
                    <div class="col-md-4">
                        @if (request('key'))
                        <h6 class="title-6">Search Key : <code>{{ request('key') }}</code></h6>
                        @endif
                    </div>
                    @if ($products->isNotEmpty()) <div class="col-md-4"><h5 class="title-5">Total - {{ $products->total() }}</h5></div> @endif
                    <div class="col-md-4">
                        <form class="form-header" action="{{ route('admin#productlist') }}" method="get">
                            @csrf
                            <input class="au-input au-input--l" type="text" value="{{ request('key') }}" name="key" placeholder="Search for category &amp; reports...">
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>





                @if ($products->isNotEmpty())

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                {{-- <th>Description</th> --}}
                                <th>Price</th>
                                <th>Waiting Time</th>
                                <th>View Count</th>
                                <th>Status</th>
                                <th>updated date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product )

                            <tr class="tr-shadow">

                                <td class="w-25">
                                    <div>
                                        @if($product->image == null)
                                        <img class="align-self-center img-thumbnail shadow-sm"  src="{{ asset('images/no-photos.png') }}" alt="{{ $product->name }}">
                                    @else
                                        <img class="align-self-center img-thumbnail shadow-sm"  src="{{ Storage::url('app/public/'.$product->image) }}" alt="{{ $product->name }}">
                                    @endif
                                    </div>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category_name }}</td>
                                {{-- <td>{{ Str::limit($product->description, 30, '[...]') }}</td> --}}
                                <td>{{ $product->price }}</td>
                                <td>{{  $product->waiting_time }}</td>
                                <td> <i class="zmdi zmdi-eye"></i> {{  $product->view_count }}</td>
                                <td>
                                    @if ($product->status == 0)
                                    <span class="status--process">Active</span>
                                    @else
                                     <span class="status--denied">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $product->updated_at->format('j-F-Y') }}</td>

                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin#productdetail',$product->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin#productedit',$product->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{ route('admin#productdelete',$product->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>

                            @endforeach


                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $products->links() }}

                        {{-- {{ $products->appends(request()->query())->links() }} --}}
                    </div>
                </div>

                @else
                <div class="alert alert-danger" role="alert">
                    There is no product here!
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

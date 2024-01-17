@extends('admin.layouts.app')
@section('title','Admin Account List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin Account List</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#list') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa fa-list"></i>List Admin Account
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
                        <h6 class="title-6">Search Key : {{ request('key') }}</h6>
                        @endif
                    </div>
                    <div class="col-md-4"><h5 class="title-5">Total - {{ $admins->total() }}</h5></div>
                    <div class="col-md-4">
                        <form class="form-header" action="" method="get">
                            @csrf
                            <input class="au-input au-input--l" type="text" value="{{ request('key') }}" name="key" placeholder="Search for category &amp; reports...">
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>





                @if ($admins->isNotEmpty())

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>created date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($admins as $admin )

                            <tr class="tr-shadow">
                                <td>

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

                                </td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->gender }}</td>
                                <td>{{ $admin->address }}</td>
                                <td class="desc">{{ $admin->created_at->format('j-F-Y') }}</td>


                                <td>
                                    <div class="table-data-feature">

                                        <a href="{{ route('admin#changerole',$admin->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Change Role">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        @if (Auth::user()->id == $admin->id)

                                        @else
                                        <a href="{{ route('admin#delete',$admin->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                        @endif



                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>

                            @endforeach


                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $admins->links() }}

                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>

                @else
                <div class="alert alert-danger" role="alert">
                    There is no Admin Account here!
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

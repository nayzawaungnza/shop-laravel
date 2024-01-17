@extends('admin.layouts.app')
@section('title','Admin Profile')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Profile</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#categorycreate') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
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
                    <div class="col-md-4"><h5 class="title-5">Total - </h5></div>
                    <div class="col-md-4">
                        <form class="form-header" action="{{ route('admin#categorylist') }}" method="get">
                            @csrf
                            <input class="au-input au-input--l" type="text" value="{{ request('key') }}" name="key" placeholder="Search for category &amp; reports...">
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>


                <section class="card">
                    <div class="card-header user-header alt bg-dark">
                        <div class="media">
                            <a href="#">
                                @if(Auth::user()->image == null)

                                    @if (Auth::user()->gender == 'male')
                                    <img src="{{ asset('images/Mavator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" />
                                    @elseif(Auth::user()->gender == 'female')
                                    <img src="{{ asset('images/Favator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" />
                                    @else
                                    <img src="{{ asset('images/avator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" />
                                    @endif
                                @else
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                @endif

                            </a>
                            <div class="media-body">
                                <h2 class="text-light display-6">{{ Auth::user()->name }}</h2>
                                <p>{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#">
                                <i class="zmdi zmdi-email"></i>{{ Auth::user()->email }}

                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <i class="zmdi zmdi-phone"></i>{{ Auth::user()->phone }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <i class="fa fa-transgender" aria-hidden="true"></i>
{{ Auth::user()->gender }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <i class="fa fa-map-marker"></i>{{ Auth::user()->address }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin#editprofile') }}" class="btn btn-dark btn-sm btn-block">Edit profile</a>
                        </li>

                    </ul>

                </section>


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

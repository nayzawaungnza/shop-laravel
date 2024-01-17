@extends('admin.layouts.app')
@section('title','Township List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Township List</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#townshipcreate') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add township
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
                    <div class="col-md-4"><h5 class="title-5">Total - {{ $townships->total() }}</h5></div>
                    <div class="col-md-4">
                        <form class="form-header" action="{{ route('admin#statelist') }}" method="get">
                            @csrf
                            <input class="au-input au-input--l" type="text" value="{{ request('key') }}" name="key" placeholder="Search for category &amp; reports...">
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>





                @if ($townships->isNotEmpty())

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th>Name</th>
                                <th>State</th>
                                <th>created date</th>
                                <th>updated date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($townships as $township )

                            <tr class="tr-shadow">
                                <td>{{  $township->id }}</td>
                                <td>{{ $township->name }}</td>
                                <td>{{ $township->state->name }}</td>
                                <td class="desc">{{ $township->created_at->format('j-F-Y') }}</td>
                                <td>{{  date('F j, Y, h:i A', strtotime($township->updated_at))}}</td>

                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button> --}}
                                        <a href="{{ route('admin#townshipedit', $township->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{ route('admin#townshipdelete',$township->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>

                            @endforeach


                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $townships->links() }}

                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>

                @else
                <div class="alert alert-danger" role="alert">
                    There is no state here!
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

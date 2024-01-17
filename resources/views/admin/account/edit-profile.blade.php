@extends('admin.layouts.app')
@section('title','Admin Edit Profile')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Edit Profile</h2>

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


                <div class="card">
                    <div class="card-body">
                        <form class="form" novalidate="" action="{{ route('admin#updateprofile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                      <div class="e-profile">
                        <div class="row">
                          <div class="col-12 col-sm-auto mb-3">
                            <div class="mx-auto" style="width: 140px;">
                              <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                {{-- <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span> --}}

                                <div class="image-wrap">
                                    <div class="image-container">
                                        <i class="fa fa-user"></i>
                                        @if(Auth::user()->image == null)

                                            @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('images/Mavator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center " style="" />
                                            @elseif(Auth::user()->gender == 'female')
                                            <img src="{{ asset('images/Favator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center " style="" />
                                            @else
                                            <img src="{{ asset('images/avator.png') }}" alt="{{ Auth::user()->name }}" class="align-self-center " style="" />
                                            @endif
                                        @else
                                        <img class="align-self-center " style="" src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                        @endif
                                        {{-- <img src="" alt="" srcset=""> --}}
                                    </div>
                                    <label for="image_input" class="camera-icon">
                                        <i class="fa fa-camera"></i>
                                    </label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image_input" accept="image/*" hidden >
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                              </div>
                            </div>
                          </div>
                          <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                              <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ Auth::user()->name }}</h4>
                              {{-- <p class="mb-0">@johnny.s</p> --}}
                              <div class="text-muted"><small>Last seen 2 hours ago</small></div>

                            </div>
                            <div class="text-center text-sm-right">
                              <span class="badge badge-secondary">{{ Auth::user()->role }}</span>
                              <div class="text-muted"><small>Joined {{ Auth::user()->created_at->format('j F Y') }}</small></div>
                            </div>
                          </div>
                        </div>
                        <ul class="nav nav-tabs">
                          <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                        </ul>
                        <div class="tab-content pt-3">
                          <div class="tab-pane active">

                              <div class="row">
                                <div class="col">
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" type="text" name="name" placeholder="Name" value="{{ old('name',Auth::user()->name) }}" >
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" type="text" name="email" placeholder="name@gmail.com" value="{{ old('email',Auth::user()->email) }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" type="number" name="phone" placeholder="09 xxx xxx xxx" value="{{ old('phone',Auth::user()->phone) }}">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                          <label>Gender</label>
                                          <select name="gender" id="select" class="form-control @error('gender') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            <option value="" {{ old('gender', Auth::user()->gender) == '' ? 'selected' : '' }}>Please Select</option>
                                            <option value="male" {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', Auth::user()->gender) == 'other' ? 'selected' : '' }}>Other</option>

                                        </select>
                                          @error('gender')
                                              <small class="invalid-feedback">{{ $message }}</small>
                                          @enderror
                                          </div>
                                      </div>

                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" type="text" name="address" placeholder="Address" value="{{ old('address',Auth::user()->address) }}">
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Role</label>
                                        <input class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" type="text" name="role" placeholder="Role" value="{{ old('role',Auth::user()->role) }}" readonly>
                                        @error('role')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    </div>
                                  </div>
                                  {{-- <div class="row">
                                    <div class="col mb-3">
                                      <div class="form-group">
                                        <label>About</label>
                                        <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                                      </div>
                                    </div>
                                  </div> --}}
                                </div>
                              </div>
                              <div class="row">
                                {{-- <div class="col-12 col-sm-6 mb-3">
                                  <div class="mb-2"><b>Change Password</b></div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Current Password</label>
                                        <input class="form-control" type="password" placeholder="••••••">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>New Password</label>
                                        <input class="form-control" type="password" placeholder="••••••">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                        <input class="form-control" type="password" placeholder="••••••"></div>
                                    </div>
                                  </div>
                                </div> --}}
                                {{-- <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                  <div class="mb-2"><b>Keeping in Touch</b></div>
                                  <div class="row">
                                    <div class="col">
                                      <label>Email Notifications</label>
                                      <div class="custom-controls-stacked px-2">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                          <label class="custom-control-label" for="notifications-blog">Blog posts</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                                          <label class="custom-control-label" for="notifications-news">Newsletter</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                          <label class="custom-control-label" for="notifications-offers">Personal Offers</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div> --}}
                              </div>
                              <div class="row">
                                <div class="col d-flex justify-content-end">
                                  <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                              </div>


                          </div>
                        </div>
                      </div>
                    </form>
                    </div>
                </div>


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

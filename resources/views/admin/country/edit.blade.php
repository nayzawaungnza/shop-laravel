@extends('admin.layouts.app')
@section('title','Edit Country')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Edit Country</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#countrylist') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-list"></i>List
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Country Form</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#countryupdate',$country->id) }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="countryName" class="control-label mb-1">Name</label>
                                <input id="countryName" name="countryName" type="text" class="form-control @error('countryName') is-invalid @enderror" value="{{ old('countryName',$country->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Country Name">
                                @error('countryName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="countryIso" class="control-label mb-1">ISO Code</label>
                                <input id="countryIso" name="countryIso" type="text" class="form-control @error('countryIso') is-invalid @enderror" value="{{ old('countryIso',$country->iso_code) }}" aria-required="true" aria-invalid="false" placeholder="Enter ISO Code">
                                @error('countryIso')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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

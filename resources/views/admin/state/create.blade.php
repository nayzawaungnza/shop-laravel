@extends('admin.layouts.app')
@section('title','Create State')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Create State</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#statelist') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-list"></i>List
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create State Form</h3>
                        </div>
                        <hr>
                        @if ($countries->isNotEmpty())

                            <form action="{{ route('admin#statestore') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="stateName" class="control-label mb-1">Name</label>
                                    <input id="stateName" name="stateName" type="text" class="form-control @error('stateName') is-invalid @enderror" value="{{ old('stateName') }}" aria-required="true" aria-invalid="false" placeholder="Enter state Name">
                                    @error('stateName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">

                                    <label for="country" class="control-label mb-1">Country</label>
                                    <select  id="country" name="country" class="form-control @error('country') is-invalid @enderror"  aria-required="true" aria-invalid="false">
                                        <option value="">Select a country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>

                        @else
                            <p>First, Add a Country <span class="text-danger">Have not a Country</span><a class="text-success btn btn-sm" href="{{ route('admin#countrycreate') }}">Add Country</a></p>
                        @endif
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

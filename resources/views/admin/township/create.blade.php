@extends('admin.layouts.app')
@section('title','Create Township')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Create Township</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#townshiplist') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-list"></i>List
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Township Form</h3>
                        </div>
                        <hr>
                        @if ($states->isNotEmpty())

                            <form action="{{ route('admin#townshipstore') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="townshipName" class="control-label mb-1">Name</label>
                                    <input id="townshipName" name="townshipName" type="text" class="form-control @error('townshipName') is-invalid @enderror" value="{{ old('townshipName') }}" aria-required="true" aria-invalid="false" placeholder="Enter state Name">
                                    @error('townshipName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">

                                    <label for="state" class="control-label mb-1">State</label>
                                    <select  id="state" name="state" class="form-control @error('state') is-invalid @enderror"  aria-required="true" aria-invalid="false">
                                        <option value="">Select a state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
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
                            <p>First, Add a State <span class="text-danger">Have not a State</span><a class="text-success btn btn-sm" href="{{ route('admin#statecreate') }}">Add State</a></p>
                        @endif
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

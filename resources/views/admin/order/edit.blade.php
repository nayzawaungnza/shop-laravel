@extends('admin.layouts.app')
@section('title','Edit Order')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Edit Order</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#orderlist') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-list"></i>List
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Order Form</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#orderupdate', $order) }}" method="post" novalidate="novalidate">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1 font-weight-bold">Customer Name</label>
                                        <input id="cc-pament" name="customerName" type="text" class="form-control @error('customerName') is-invalid @enderror" value="{{ old('customerName',$order->customer->name) }}" aria-required="true" aria-invalid="false" placeholder="Customer Name" readonly>
                                        @error('customerName')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date" class="control-label mb-1 font-weight-bold">Date</label>
                                        <input type="text" name="date" id="date" class="form-control" value="{{  date('F j, Y, h:i A', strtotime($order->order_date))}}" placeholder="{{  date('F j, Y, h:i A', strtotime($order->order_date))}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="order-id" class="control-label mb-1 font-weight-bold">Order ID</label>
                                        <input type="text" name="order-id" id="order-id" class="form-control" value="{{ $order->id}}" placeholder="Order ID" readonly>
                                    </div>
                                </div>
                                @if ($order->company_name)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="company-id" class="control-label mb-1 font-weight-bold">Company Name</label>
                                        <input type="text" name="company-id" id="company-id" class="form-control" value="{{ $order->company_name}}" placeholder="Company Name" readonly>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="table-responsive mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Tax</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            @foreach ($order->items as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="productimgname">
                                                <a class="product-img">
                                                <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                                                </a>
                                                <a href="javascript:void(0);">{{ $item->product->name }}</a>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price,2) }}</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>{{ number_format($item->price * $item->quantity, 2) }} MMK</td>
                                                <td>
                                                <a href="javascript:void(0);" class="delete-set"><img src="{{ asset('images/delete.svg') }}" alt="svg"></a>
                                                </td>
                                            </tr>
                                            @endforeach



                                </tbody>
                            </table>
                        </div>



                           <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="payment_status">Payment Status</label>
                                        <select class="form-control bg-{{ $order->payment_status }} text-white @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                                            <option value="paid"  {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>paid</option>
                                            <option value="unpaid"  {{ old('payment_status', $order->payment_status) == 'unpaid' ? 'selected' : '' }}>unpaid</option>
                                            <option value="overdue" {{ old('payment_status', $order->payment_status) == 'overdue' ? 'selected' : '' }}>overdue</option>
                                        </select>
                                        @error('payment_status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control bg-{{ $order->status }} text-white @error('status') is-invalid @enderror" id="status" name="status">
                                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="failed" {{ old('status', $order->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                            <option value="shipped" {{ old('status', $order->status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ old('status', $order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="canceled" {{ old('status', $order->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
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

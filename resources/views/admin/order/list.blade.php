@extends('admin.layouts.app')
@section('title','Order List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        {{-- <a href="#">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Product
                            </button>
                        </a> --}}
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>

                    </div>
                </div>

                @if (session('success'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

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
                    <div class="col-md-4"><h5 class="title-5">Total - {{ count($orders) }}</h5></div>
                    <div class="col-md-4">
                        <form class="form-header" action="{{ route('admin#orderlist') }}" method="get">
                            @csrf
                            <input class="au-input au-input--l" type="text" value="{{ request('key') }}" name="key" placeholder="Search for category &amp; reports...">
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>





                @if ($orders->isNotEmpty())


                <div class="table-responsive">
                    <form method="POST" action="{{ route('admin#orderbulkAction') }}">
                        @csrf
                        <div class="alignleft actions bulkactions ">
                            {{-- <label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label> --}}
                            <select name="action" class="bulk-action" id="bulk-action-selector-bottom">
                                <option value="-1">Bulk actions</option>
                                <option value="delete">Delete</option>
                                <!-- Add more action options as needed -->
                            </select>
                            <input type="submit" id="doaction2" class="button action btn-action-apply au-btn au-btn-icon au-btn--green au-btn--small" value="Apply">
                        </div>
                        <table class="table table-data2 " style="overflow-y: auto;">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="au-checkbox">
                                            <input type="checkbox" id="select-all-checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </th>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Payment via</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order )

                                <tr class="tr-shadow">

                                    <td>
                                        <label class="au-checkbox">
                                            <input type="checkbox" name="selectedIds[]" value="{{ $order->id }}">
                                            <span class="au-checkmark"></span>
                                        </label>

                                    </td>
                                    <td>
                                        {{-- {{  DateTime::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('j-F-Y H:i:s') }} --}}
                                        {{  date('F j, Y, h:i A', strtotime($order->order_date))}}
                                    </td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ ucfirst(str_replace('_',' ',$order->payment_method)) }}
                                        {{-- {{ $order->shipping_address }} ၊<br>
                                        {{ $order->shipping_township->name }} ၊<br>
                                        {{ $order->shipping_state->name }} ၊<br>
                                        {{ $order->shipping_country->name }} ၊<br>
                                        {{ $order->shipping_zip }} --}}
                                    </td>
                                    <td>{{ number_format($order->total_amount,2) }} MMK
                                        {{-- @if ($order->different_shipping_address)
                                            {{ $order->different_shipping_address }} ၊<br>
                                            {{ $order->different_shipping_township->name }} ၊<br>
                                            {{ $order->different_shipping_state->name }} ၊<br>
                                            {{ $order->different_shipping_country->name }}
                                            {{ $order->different_shipping_phone }}
                                        @else
                                            {{ $order->shipping_address }} ၊<br>
                                            {{ $order->shipping_township->name }} ၊<br>
                                            {{ $order->shipping_state->name }} ၊<br>
                                            {{ $order->shipping_country->name }} ၊<br>
                                            {{ $order->shipping_zip }}

                                        @endif --}}
                                    </td>
                                    <td>
                                    <span class="badges bg-{{ $order->payment_status }}">{{ $order->payment_status }}</span>
                                    </td>
                                    <td><span class="badges bg-{{ $order->status }}">{{ $order->status }}</span></td>
                                    <td>


                                        <div class="table-data-feature">
                                            <a href="" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin#orderedit', $order) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a href="" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cs-invoice_btns cs-hide_print">
                                            <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24"/></svg>
                                            <span>Print</span>
                                            </a>
                                            <a href="{{ route('admin#invoice.generate', $order->id ) }}" id="download_btn" class="cs-invoice_btn cs-color2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Download</title><path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288"/></svg>
                                            <span>Download</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>

                                @endforeach


                            </tbody>
                        </table>
                    </form>

                    <div class="mt-3">
                        {{-- {{ $orders->links() }} --}}

                        {{-- {{ $products->appends(request()->query())->links() }} --}}
                    </div>
                </div>

                @else
                <div class="alert alert-danger" role="alert">
                    There is no order here!
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsource')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAllCheckbox = document.getElementById("select-all-checkbox");
        const checkboxes = document.querySelectorAll('input[name="selectedIds[]"]');

        selectAllCheckbox.addEventListener("change", function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                selectAllCheckbox.checked = Array.from(checkboxes).every(function(checkbox) {
                    return checkbox.checked;
                });
            });
        });
    });
</script>
@endsection

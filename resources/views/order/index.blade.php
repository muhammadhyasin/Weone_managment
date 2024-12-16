@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total Orders</h4>
                <br>
                <form method="GET" action="{{ request()->url() }}">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="type">Order Type:</label>
                            <select name="type" id="type" class="form-select" onchange="window.location.href=this.value">
                                <option value="{{ route('orders.index') }}" {{ $type === 'all' ? 'selected' : '' }}>All</option>
                                <option value="{{ route('orders.pending') }}" {{ $type === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="{{ route('orders.completed') }}" {{ $type === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="{{ route('orders.refunded') }}" {{ $type === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ request()->url() }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>                              
                <br>
                

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th style="display:none;">Created At</th>
                        <th>Product No</th>
                        <th>Item Name</th>
                        <th>Customer Name</th>
                        <th>Zip Code</th>
                        <th>Status</th>
                        <th>Delivery Time</th>
                        <th>Delivery Date</th>
                        <th style="width: 120px;">Amount</th>
                    </tr>
                    </thead>


                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td style="display:none;">{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;"><h6 class="mb-0">{{ $order->product_item_no }}</h6></td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">{{ \Illuminate\Support\Str::words($order->product_name, 2, '...') }}</td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">{{ $order->customer_name }}</td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">{{ $order->postcode }}</td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">
                                    <div class="font-size-13">
                                        @php
                                            // Determine the color class based on order status
                                            $statusColor = 'text-warning'; // default yellow for pending
                                            if ($order->order_status === 'Completed') {
                                                $statusColor = 'text-success'; // green for completed
                                            } elseif ($order->order_status === 'refunded') {
                                                $statusColor = 'text-danger'; // red for cancelled
                                            }elseif ($order->order_status === 'Cancelled') {
                                                $statusColor = 'text-danger'; // red for cancelled
                                            }
                                            
                                        @endphp
                                        <i class="ri-checkbox-blank-circle-fill font-size-10 {{ $statusColor }} align-middle me-2"></i>
                                        {{ ucfirst($order->order_status) }}
                                    </div>
                                </td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">{{ $order->delivery_start_time }}</td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M, Y') }}</td>
                                <td onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">£{{ number_format($order->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->



@endsection
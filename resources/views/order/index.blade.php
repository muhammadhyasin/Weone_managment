@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Total Orders</h4>
                <br>
                

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Product No</th>
                        <th>Item Name</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                        <th style="width: 120px;">Amount</th>
                    </tr>
                    </thead>


                    <tbody>
                        @foreach($orders as $order)
                            <tr onclick="window.location='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">
                                <td><h6 class="mb-0">{{ $order->product_item_no }}</h6></td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>
                                    <div class="font-size-13">
                                        @php
                                            // Determine the color class based on order status
                                            $statusColor = 'text-warning'; // default yellow for pending
                                            if ($order->order_status === 'Completed') {
                                                $statusColor = 'text-success'; // green for completed
                                            } elseif ($order->order_status === 'refunded') {
                                                $statusColor = 'text-danger'; // red for cancelled
                                            }
                                        @endphp
                                        <i class="ri-checkbox-blank-circle-fill font-size-10 {{ $statusColor }} align-middle me-2"></i>
                                        {{ ucfirst($order->order_status) }}
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M, Y') }}</td>
                                <td>£{{ number_format($order->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->



@endsection
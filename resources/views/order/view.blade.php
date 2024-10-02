@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Details</h4>
                <br>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="product_item_no" class="form-label">Product Number</label>
                        <h4>{{ $order->product_item_no }}</h4>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <h4>{{ $order->product_name }}</h4>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <h4>{{ $order->price }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <h5>{{ $order->customer_name }}</h5>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <h5>{{ $order->phone_number }}</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <h5>{{ $order->address }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="postcode" class="form-label">Zip Code</label>
                        <h5>{{ $order->postcode }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="delivery_date" class="form-label">Delivery Date</label>
                        <h5>{{ $order->delivery_date }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="delivery_start_time" class="form-label">Estimete Delivery Time From</label>
                        <h5>{{ $order->delivery_start_time }} To {{ $order->delivery_end_time }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="order_status" class="form-label">Status</label>
                        <h5>{{ ucfirst($order->order_status) }}</h5>
                    </div>
                </div>

                <div>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection

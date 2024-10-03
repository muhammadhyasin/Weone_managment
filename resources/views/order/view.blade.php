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
                        <label for="delivery_start_time" class="form-label">Estimete Delivery Time Between</label>
                        <h5>{{ $order->delivery_start_time }} To {{ $order->delivery_end_time }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="order_status" class="form-label">Status</label>
                        <h5 class="{{ $order->order_status == 'pending' ? 'text-warning' : ($order->order_status == 'Completed' ? 'text-success' : ($order->order_status == 'refunded' ? 'text-danger' : '')) }}">
                            {{ ucfirst($order->order_status) }}
                        </h5>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="delivery_date" class="form-label">Payment Method</label>
                        <h5>{{ $order->payment_method }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="delivery_start_time" class="form-label">Payment Status</label>
                        <h5>{{ $order->payment_status }} </h5>
                    </div>        
                </div>

                <div>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                    @if($order->order_status !== 'refunded' && $order->order_status !== 'Completed')
                            <a>
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Edit Orders</button>
                            </a>
                        @endif
                        @if($order->order_status === 'Completed')
                        <a href="{{ route('invoice.show', $order->id) }}" class="btn btn-success">Print Invoice</a>
                    @endif

                        <!-- Show the Refund button only if the status is 'completed' -->
                        @if($order->order_status === 'Completed' && !is_null($order->payment_status) && $order->payment_status !== 'pending')
                        <button type="button" class="btn btn-danger waves-effect waves-light m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Refund</button>
                    @endif
                    
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Refund</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>This action cannot be reverted. Do you want to refund this order?</p>
                                    <form action="{{ route('orders.refund', $order->id) }}" method="POST" id="refundForm">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="order_status" value="refunded">
                                        <input type="hidden" name="price" value="{{ -$order->price }}">
                                        
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 50vw;">
                    <div class="offcanvas-header">
                      <h5 id="offcanvasRightLabel">Edit Order Details</h5>
                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body offcanvas-lg">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        
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
                        
                                        <!-- Change action to update the order -->
                                        <form class="needs-validation" method="POST" action="{{ route('orders.update', $order->id) }}" novalidate>
                                            @csrf <!-- Add CSRF protection -->
                                            @method('PUT') <!-- Specify the HTTP method -->
                        
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="product_item_no" class="form-label">Product Number</label>
                                                        <input type="number" class="form-control" name="product_item_no" id="product_item_no" placeholder="Product Number" value="{{ old('product_item_no', $order->product_item_no) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('product_item_no')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="{{ old('product_name', $order->product_name) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('product_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Product Price</label>
                                                        <input type="number" class="form-control" name="price" id="price" placeholder="Product Price" value="{{ old('price', $order->price) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="customer_name" class="form-label">Customer Name</label>
                                                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" value="{{ old('customer_name', $order->customer_name) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('customer_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone_number" class="form-label">Phone Number</label>
                                                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number', $order->phone_number) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('phone_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ old('address', $order->address) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="postcode" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Zip" value="{{ old('postcode', $order->postcode) }}" required>
                                                        <div class="invalid-feedback">Please provide a valid zip.</div>
                                                        @error('postcode')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="delivery_date" class="form-label">Delivery Date</label>
                                                        <input class="form-control" type="date" name="delivery_date" id="delivery_date" value="{{ old('delivery_date', $order->delivery_date) }}" required>
                                                        <div class="invalid-feedback">Please select a valid Date.</div>
                                                        @error('delivery_date')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="delivery_start_time" class="form-label">Delivery Start Time</label>
                                                        <input class="form-control" type="time" name="delivery_start_time" id="delivery_start_time" value="{{ old('delivery_start_time', $order->delivery_start_time) }}" required>
                                                        <div class="invalid-feedback">Please provide a valid Time.</div>
                                                        @error('delivery_start_time')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="delivery_end_time" class="form-label">Delivery End Time</label>
                                                        <input class="form-control" type="time" name="delivery_end_time" id="delivery_end_time" value="{{ old('delivery_end_time', $order->delivery_end_time) }}" required>
                                                        <div class="invalid-feedback">Please provide a valid Time.</div>
                                                        @error('delivery_end_time')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="payment_method" class="form-label">Payment Method</label>
                                                        <select id="payment_method" class="form-control select2-search-disable" name="payment_method" required>
                                                            <option value="">Select Status</option>
                                                            <option value="Card" {{ old('payment_method', $order->payment_method) == 'Card' ? 'selected' : '' }}>Card</option>
                                                            <option value="Cash" {{ old('payment_method', $order->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                                        </select>
                                                        @error('payment_method')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="payment_status" class="form-label">Payment Status</label>
                                                        <select id="payment_status" class="form-control select2-search-disable" name="payment_status" required>
                                                            <option value="">Select Status</option>
                                                            <option value="pending" {{ old('payment_status', $order->payment_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Completed" {{ old('payment_status', $order->payment_status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        </select>
                                                        @error('payment_status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div>
                                                <button class="btn btn-primary" type="submit">Update Order</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection

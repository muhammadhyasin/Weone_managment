@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Order Details</h4>
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
                                <label for="order_status" class="form-label">Status</label>
                                <select id="order_status" class="form-control select2-search-disable" name="order_status" required>
                                    <option value="">Select Status</option>
                                    <option value="Pending" {{ old('order_status', $order->order_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Completed" {{ old('order_status', $order->order_status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Canceled" {{ old('order_status', $order->order_status) == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                @error('order_status')
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
@endsection

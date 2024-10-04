@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Order Details</h4>
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

                <form class="needs-validation" method="POST" action="{{ route('orders.store') }}" novalidate>
                    @csrf <!-- Add CSRF protection -->

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="product_item_no" class="form-label">Product Number</label>
                                <input type="number" class="form-control" name="product_item_no" id="product_item_no" placeholder="Product Number" value="{{ old('product_item_no') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('product_item_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="{{ old('product_name') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Product Price" value="{{ old('price') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="advance_amount" class="form-label">Advance Amount</label>
                                <input type="number" class="form-control" name="advance_amount" id="advance_amount" placeholder="Advance Amount" value="{{ old('advance_amount') }}" >
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" value="{{ old('customer_name') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ old('address') }}" required>
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
                                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Zip" value="{{ old('postcode') }}" required>
                                <div class="invalid-feedback">Please provide a valid zip.</div>
                                @error('postcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="postcode" class="form-label">Description</label>
                                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Zip" value="{{ old('postcode') }}" >
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="delivery_date" class="form-label">Delivery Date</label>
                                <input class="form-control" type="date" name="delivery_date" id="delivery_date" value="{{ old('delivery_date') }}" required>
                                <div class="invalid-feedback">Please select a valid Date.</div>
                                @error('delivery_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="delivery_start_time" class="form-label">Delivery Start Time</label>
                                <div class="input-group">
                                    <select name="delivery_start_hour" id="delivery_start_hour" class="form-select" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('delivery_start_hour') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="delivery_start_ampm" id="delivery_start_ampm" class="form-select" required>
                                        <option value="AM" {{ old('delivery_start_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                                        <option value="PM" {{ old('delivery_start_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Please provide a valid Time.</div>
                                @error('delivery_start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="delivery_end_time" class="form-label">Delivery End Time</label>
                                <div class="input-group">
                                    <select name="delivery_end_hour" id="delivery_end_hour" class="form-select" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('delivery_end_hour') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="delivery_end_ampm" id="delivery_end_ampm" class="form-select" required>
                                        <option value="AM" {{ old('delivery_end_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                                        <option value="PM" {{ old('delivery_end_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Please provide a valid Time.</div>
                                @error('delivery_end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>

                    <div>
                        <button class="btn btn-primary" type="submit">Create Order</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection

@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Pickup Details</h4>
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

                <form class="needs-validation" method="POST" action="{{ route('pickup.store') }}" novalidate>
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
                                <label for="price" class="form-label">Pickup Price</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Pickup Price" value="{{ old('price') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                <label for="pickup_address" class="form-label">Pickup Address</label>
                                <input type="text" class="form-control" name="pickup_address" id="pickup_address" placeholder="Pickup Address" value="{{ old('pickup_address') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('pickup_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="postcode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Zip Code" value="{{ old('postcode') }}" required>
                                <div class="invalid-feedback">Please provide a valid zip code.</div>
                                @error('postcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="pickup_date" class="form-label">Pickup Date</label>
                                <input class="form-control" type="date" name="pickup_date" id="pickup_date" value="{{ old('pickup_date') }}" required>
                                <div class="invalid-feedback">Please select a valid date.</div>
                                @error('pickup_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="pickup_start_time" class="form-label">Pickup Time</label>
                                <input class="form-control" type="time" name="pickup_start_time" id="pickup_start_time" value="{{ old('pickup_start_time') }}" required>
                                <div class="invalid-feedback">Please provide a valid time.</div>
                                @error('pickup_start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-primary" type="submit">Create Pickup</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection

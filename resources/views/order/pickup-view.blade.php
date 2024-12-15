@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pickup Details</h4>
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
                        <h4>{{ $pickup->product_item_no }}</h4>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <h4>{{ $pickup->product_name }}</h4>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <h4>£ {{ $pickup->price }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <h5>{{ $pickup->customer_name }}</h5>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <h5>{{ $pickup->phone_number }}</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pickup_address" class="form-label">Address</label>
                        <h5>{{ $pickup->pickup_address }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="postcode" class="form-label">Zip Code</label>
                        <h5>{{ $pickup->postcode }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="postcode" class="form-label">Description</label>
                        <h5>{{ $pickup->description }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="pickup_date" class="form-label">Pickup Date</label>
                        <h5>{{ $pickup->pickup_date }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pickup_start_time" class="form-label">Estimate Pickup Start Time </label>
                        <h5>{{ $pickup->pickup_start_time }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pickup_end_time" class="form-label">Estimate Pickup End Time </label>
                        <h5>{{ $pickup->pickup_end_time }}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pickup_status" class="form-label">Pickup Status</label>
                        <h5 class="{{ $pickup->pickup_status == 'pending' ? 'text-warning' : ($pickup->pickup_status == 'Completed' ? 'text-success' : ($pickup->pickup_status == 'refunded' || 'Cancelled' ? 'text-danger' : '')) }}">
                            {{ ucfirst($pickup->pickup_status) }}
                        </h5>
                    </div>
                    
                    <div>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                        @if($pickup->pickup_status !== 'refunded' && $pickup->pickup_status !== 'Completed' && $pickup->pickup_status !== 'Cancelled')
                                <a>
                                    <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Edit Orders</button>
                                </a>
                            @endif    
                    </div>
                </div>
                <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 50vw;">
                    <div class="offcanvas-header">
                      <h5 id="offcanvasRightLabel">Edit Pickup Details</h5>
                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body offcanvas-lg">
                        <div class="row">
                            <div class="col-xl-12 col-12">
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
                                        <form class="needs-validation" method="POST" action="{{ route('pickups.update', $pickup->id) }}" novalidate>
                                            @csrf <!-- Add CSRF protection -->
                                            @method('PUT') <!-- Specify the HTTP method -->
                        
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="product_item_no" class="form-label">Product Number</label>
                                                        <input type="text" class="form-control" name="product_item_no" id="product_item_no" placeholder="Product Number" value="{{ old('product_item_no', $pickup->product_item_no) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('product_item_no')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="{{ old('product_name', $pickup->product_name) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('product_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Product Price</label>
                                                        <input type="number" class="form-control" name="price" id="price" placeholder="Product Price" value="{{ old('price', $pickup->price) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="customer_name" class="form-label">Customer Name</label>
                                                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" value="{{ old('customer_name', $pickup->customer_name) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('customer_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone_number" class="form-label">Phone Number</label>
                                                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number', $pickup->phone_number) }}" required>
                                                        <div class="valid-feedback">Looks good!</div>
                                                        @error('phone_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="pickup_address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" name="pickup_address" id="pickup_address" placeholder="Address" value="{{ old('pickup_address', $pickup->pickup_address) }}" required>
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
                                                        <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Zip" value="{{ old('postcode', $pickup->postcode) }}" required>
                                                        <div class="invalid-feedback">Please provide a valid zip.</div>
                                                        @error('postcode')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <input type="text" class="form-control" name="description" id="description" placeholder="description" value="{{ old('description', $pickup->description) }}" >
                                                        <div class="invalid-feedback">Please provide a description.</div>
                                                        @error('advance_amount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pickup_date" class="form-label">Pickup Date</label>
                                                        <input class="form-control" type="date" name="pickup_date" id="pickup_date" value="{{ old('pickup_date', $pickup->pickup_date) }}" required>
                                                        <div class="invalid-feedback">Please select a valid Date.</div>
                                                        @error('pickup_date')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pickup_start_time" class="form-label">Delivery Start Time</label>
                                                        <input class="form-control" type="time" name="pickup_start_time" id="pickup_start_time" value="{{ old('pickup_start_time', $pickup->pickup_start_time) }}" required>
                                                        <div class="invalid-feedback">Please provide a valid Time.</div>
                                                        @error('pickup_start_time')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pickup_end_time" class="form-label">Delivery End Time</label>
                                                        <input class="form-control" type="time" name="pickup_end_time" id="pickup_end_time" value="{{ old('pickup_end_time', $pickup->pickup_end_time) }}" required>
                                                        <div class="invalid-feedback">Please provide a valid Time.</div>
                                                        @error('pickup_end_time')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pickup_status" class="form-label">Status</label>
                                                        <select id="pickup_status" class="form-control select2-search-disable" name="pickup_status" required>
                                                            <option value="pending">pending</option>
                                                            <option value="Cancelled" {{ old('pickup_status', $pickup->pickup_status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                            <option value="Completed">Completed</option>
                                                        </select>
                                                        @error('pickup_status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div>
                                                <button class="btn btn-primary" type="submit">Update Pickup</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                             <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Pickup Logs</h4>
            <div class="table-responsive">
                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead><!-- end thead -->
                    <tbody>
                        @foreach($logs as $log)
                            <tr style="cursor: pointer;">
                                <td>
                                    <div class="font-size-13">
                                        {{ $log->user->name }} <!-- Assuming you have a 'name' field in the User model -->
                                    </div>
                                </td>
                                <td>
                                    <div class="font-size-13">
                                        {{ $log->action }}
                                    </div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($log->created_at)->timezone('Asia/Kolkata')->format('d M, Y H:i') }}


                                </td>
                            </tr>
                        @endforeach
                    </tbody><!-- end tbody -->
                </table>
                <!-- end table -->
            </div>
        </div>
    </div>
</div>
@endsection

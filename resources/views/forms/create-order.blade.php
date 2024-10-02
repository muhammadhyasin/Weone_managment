@extends('layouts.main')
@section('content')
<div class="row">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enter Order Details</h4>
                    <br>
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Number</label>
                                    <input type="number" class="form-control" id="validationCustom01"
                                        placeholder="Product Number" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Product Name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Price</label>
                                    <input type="number" class="form-control" id="validationCustom01"
                                        placeholder="Product Price" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Customer name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Customer name"  required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" id="validationCustom01"
                                        placeholder="Phone Number"  required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Address</label>
                                    <input type="address" class="form-control" id="validationCustom02"
                                        placeholder="Address"  required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">State</label>
                                   <input type="text" class="form-control" id="validationCustom02" placeholder="State" required>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">City</label>
                                    <input type="text" class="form-control" id="validationCustom04"
                                        placeholder="City" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid city.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="validationCustom05"
                                        placeholder="Zip" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid zip.
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Delivery Date</label>
                                    <input class="form-control" type="date" id="example-date-input">
                                    <div class="invalid-feedback">
                                        Please select a valid Date.
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Between</label>
                                    <input class="form-control" type="time" id="example-time-input">
                                        
                                    <div class="invalid-feedback">
                                        Please provide a valid Time.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">To</label>
                                    <input class="form-control" type="time" id="example-time-input">
                                        
                                    <div class="invalid-feedback">
                                        Please provide a valid Time.
                                    </div>
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
@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Revenue</p>
                        <h4 class="mb-2">1452 £</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="mdi mdi-currency-gbp font-size-24 text-success"></i>  
                        </span>
                    </div>
                </div>                                            
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Pending Orders (Used)</p>
                        <h4 class="mb-2">938</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="ri-shopping-cart-2-line font-size-24"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Completed Orders (Used)</p>
                        <h4 class="mb-2">8246</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-user-3-line font-size-24 text-danger"></i>  
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total expenses</p>
                        <h4 class="mb-2">29670</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="mdi mdi-currency-gbp font-size-24 text-danger"></i>  
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div>

                <h4 class="card-title mb-4">Latest Transactions</h4>

                <div class="table-responsive">
                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Product No</th>
                                <th>Item Name</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Delivery Date</th>
                                <th style="width: 120px;">Amount</th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            <tr>
                                <td><h6 class="mb-0">Charles Casey</h6></td>
                                <td>Web Developer</td>
                                <td>
                                    23
                                </td>
                                <td>
                                    <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</div>
                                </td>
                                <td>
                                    04 Apr, 2021
                                </td>
                                <td>$42,450</td>
                            </tr>
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
            </div><!-- end card -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <select class="form-select shadow-none form-select-sm">
                        <option selected>Apr</option>
                        <option value="1">Mar</option>
                        <option value="2">Feb</option>
                        <option value="3">Jan</option>
                    </select>
                </div>
                <h4 class="card-title mb-4">Monthly Earnings</h4>
                
                <div class="row">
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>3475</h5>
                            <p class="mb-2 text-truncate">Market Place</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>458</h5>
                            <p class="mb-2 text-truncate">Last Week</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>9062</h5>
                            <p class="mb-2 text-truncate">Last Month</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="mt-4">
                    <div id="donut-chart" class="apex-charts"></div>
                </div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div>
@endsection
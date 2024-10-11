@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ Auth::user()->role }}</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $startDate ?? '' }}" placeholder="Start Date">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $endDate ?? '' }}" placeholder="End Date">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="sort_order" class="form-label">Order:</label>
                    <select name="sort_order" id="sort_order" class="form-select">
                        <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-3 ">
                <button type="submit" class="btn btn-primary">Filter & Sort</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>


<div class="row">
    @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Revenue</p>
                        <h4 class="mb-2">£{{ number_format($totalRevenue, 2) }}</h4>
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
    </div>
    @endif<!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card" onclick="window.location='{{ route('orders.pending') }}'">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Pending Orders (Used)</p>
                        <h4 class="mb-2">{{ $pendingOrdersCount }}</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-warning rounded-3">
                            <i class="ri-shopping-cart-2-fill font-size-24"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card" onclick="window.location='{{ route('orders.completed') }}'">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Completed Orders (Used)</p>
                        <h4 class="mb-2">{{ $CompletedOrdersCount }}</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-check-double-line font-size-24 text-success"></i>  
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card " onclick="window.location='{{ route('orders.refunded') }}'">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Refunded Orders (Used)</p>
                        <h4 class="mb-2">{{ $RefundedOrdersCount }}</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-refund-2-line font-size-24 text-danger"></i>  
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
                        <p class="text-truncate font-size-14 mb-2">Cancelled Orders (Used)</p>
                        <h4 class="mb-2">{{ $CancelledOrdersCount }}</h4>
                        {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-close-line font-size-24 text-danger"></i>  
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div>
    <div class="col-xl-3 col-md-6">
        @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total expenses</p>
                        <h4 class="mb-2">£{{ $totalExpenses}}</h4>
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
        @endif
    </div><!-- end col -->
</div><!-- end row -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                

                <h4 class="card-title mb-4">Latest Orders</h4>

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
                                elseif ($order->order_status === 'Cancelled') {
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
        </tbody><!-- end tbody -->
    </table>
    <!-- end table -->
</div>

            </div><!-- end card -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin'))
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Transaction</h4>
                <div class="table-responsive">
                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Source</th>
                                <th>Date</th>
                                <th style="width: 120px;">Amount</th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            @foreach($revenu as $revenues)
                                <tr style="cursor: pointer;">
                                    <td>
                                        <div class="font-size-13">
                                            @php
                                                // Determine the color class based on the source (completed, refunded, etc.)
                                                $statusColor = 'text-warning'; // default yellow for pending
                                                if ($revenues->source === 'orders' && $revenues->amount > 0) {
                                                    $statusColor = 'text-success'; // green for completed
                                                } elseif ($revenues->source === 'orders' && $revenues->amount < 0) {
                                                    $statusColor = 'text-danger'; // red for refunded
                                                }
                                            @endphp
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 {{ $statusColor }} align-middle me-2"></i>
                                            {{ ucfirst($revenues->source) }}
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($revenues->created_at)->format('d M, Y') }}</td>
                                    <td>£{{ number_format($revenues->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody><!-- end tbody -->
                        
                    </table>
                    <!-- end table -->
                </div>
                
                <!-- end row -->

                
            </div>
        </div><!-- end card -->
        @endif
    </div><!-- end col -->
</div>
@endsection
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Total Pickups</h4>
                <br>
                <form method="GET" action="{{ route('pickup.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('pickup.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <br>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Product No</th>
                        <th>Item Name</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Pickup Date</th>
                        <th style="width: 120px;">Amount</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($pickups as $pickup)
                            <tr onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">
                                <td><h6 class="mb-0">{{ $pickup->product_item_no }}</h6></td>
                                <td>{{ $pickup->product_name }}</td>
                                <td>{{ $pickup->customer_name }}</td>
                                <td>
                                    <div class="font-size-13">
                                        @php
                                            // Determine the color class based on pickup status
                                            $statusColor = 'text-warning'; // default yellow for pending
                                            if ($pickup->pickup_status === 'Completed') {
                                                $statusColor = 'text-success'; // green for completed
                                            } elseif ($pickup->pickup_status === 'cancelled') {
                                                $statusColor = 'text-danger'; // red for cancelled
                                            }
                                        @endphp
                                        <i class="ri-checkbox-blank-circle-fill font-size-10 {{ $statusColor }} align-middle me-2"></i>
                                        {{ ucfirst($pickup->pickup_status) }}
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pickup->pickup_date)->format('d M, Y') }}</td>
                                <td>£{{ number_format($pickup->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
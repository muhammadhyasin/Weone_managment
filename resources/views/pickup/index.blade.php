@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Total Pickups</h4>
                <br>
                <form method="GET" action="{{ request()->url() }}">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="type">Pickup Type:</label>
                            <select name="type" id="type" class="form-select" onchange="window.location.href=this.value">
                                <option value="{{ route('pickup.index') }}" {{ $type === 'all' ? 'selected' : '' }}>All</option>
                                <option value="{{ route('pickup.pending') }}" {{ $type === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="{{ route('pickup.completed') }}" {{ $type === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ request()->url() }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
                <br>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th style="display:none;">Created At</th>
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
                            <tr>
                                <td style="display:none;">{{ \Carbon\Carbon::parse($pickup->created_at)->format('d M, Y') }}</td>
                                <td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;"><h6 class="mb-0">{{ $pickup->product_item_no }}</h6></td>
                                <td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">{{ $pickup->product_name }}</td>
                                <td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">{{ $pickup->customer_name }}</td>
                                <td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">
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
                                </td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">
                                <td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">{{ \Carbon\Carbon::parse($pickup->pickup_date)->format('d M, Y') }}</td>
                                <td onclick="window.location='{{ route('pickup.show', $pickup->id) }}'" style="cursor: pointer;">£{{ number_format($pickup->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <form method="POST" action="{{ route('expense.store') }}">
                @csrf
            <label for="category" class="form-label">Expense Category</label>
            <select id="category" class="form-control" name="category" required>
                <option value="">Select Category</option>
                <option value="diesel" {{ old('category') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="cleaning_supplies" {{ old('category') == 'cleaning_supplies' ? 'selected' : '' }}>Cleaning Supplies</option>
                <option value="maintenance" {{ old('category') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <div class="valid-feedback">Looks good!</div>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="amount" class="form-label">Expense Amount</label>
            <input type="number" class="form-control" name="amount" id="amount" placeholder="Expense Amount" value="{{ old('amount') }}" required>
            <div class="valid-feedback">Looks good!</div>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description') }}">
            <div class="valid-feedback">Looks good!</div>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div>
    <button class="btn btn-primary" type="submit">Add Expense</button>
</form>
</div>
<div class="table-responsive">
    <table class="table table-centered table-striped mb-0 align-middle table-hover table-bordered table-sm">
        <thead class="table-light">
            <tr class="text-center">
                <th>Category</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Created By</th>
                <th>Date</th>
                <th style="width: 120px;">Actions</th>
            </tr>
        </thead>
        <!-- end thead -->
        <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td class="text-center">{{ ucfirst($expense->category) }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ $expense->description }}</td>
                    <td class="text-center fw-bold">£{{ number_format($expense->amount, 2) }}</td>
                    <td class="text-center">{{ $expense->created_by }}</td> <!-- Assuming you have a way to get the creator's name -->
                    <td class="text-center">{{ \Carbon\Carbon::parse($expense->created_at)->format('d M, Y') }}</td>
                    <td class="text-center">
                        <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this expense?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <!-- end tbody -->
    </table>
    <!-- end table -->
</div>

@endsection


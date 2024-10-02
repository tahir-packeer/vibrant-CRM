@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Edit Customization</h2>

        <form action="{{ route('customizations.update', $customization->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="status" class="form-label text-white">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="Processing" {{ $customization->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Pending Payment" {{ $customization->status == 'Pending Payment' ? 'selected' : '' }}>Pending Payment</option>
                    <option value="Confirm Payment" {{ $customization->status == 'Confirm Payment' ? 'selected' : '' }}>Confirm Payment</option>
                    <option value="Confirmed" {{ $customization->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Cancelled" {{ $customization->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="unit_price" class="form-label text-white">Unit Price</label>
                <input type="number" name="unit_price" class="form-control" id="unit_price" value="{{ $customization->unit_price }}" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label text-white">Total Price</label>
                <input type="number" name="total_price" class="form-control" id="total_price" value="{{ $customization->total_price }}" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

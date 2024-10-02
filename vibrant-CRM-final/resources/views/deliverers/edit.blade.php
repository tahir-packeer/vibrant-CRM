@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Update Delivery Status</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Update Deliverer Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('deliverers.update', $deliverer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="delivery_status" class="form-label">Delivery Status</label>
                                <select name="delivery_status" class="form-control" id="delivery_status" required>
                                    <option value="Pending" {{ $deliverer->delivery_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Transit" {{ $deliverer->delivery_status == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                                    <option value="Delivered" {{ $deliverer->delivery_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Canceled" {{ $deliverer->delivery_status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="delivery_note" class="form-label">Delivery Note</label>
                                <textarea name="delivery_note" class="form-control" id="delivery_note">{{ $deliverer->delivery_note }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

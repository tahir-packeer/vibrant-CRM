@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-primary">Assign Deliverer</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Assign New Deliverer</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('deliverers.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="order_id" class="form-label">Select Order</label>
                                <select name="order_id" class="form-control" id="order_id" required>
                                    @foreach($unassignedOrders as $order)
                                        <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="deliverer_name" class="form-label">Deliverer Name</label>
                                <input type="text" name="deliverer_name" class="form-control" id="deliverer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="delivery_status" class="form-label">Delivery Status</label>
                                <select name="delivery_status" class="form-control" id="delivery_status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="In Transit">In Transit</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="delivery_note" class="form-label">Delivery Note</label>
                                <textarea name="delivery_note" class="form-control" id="delivery_note"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

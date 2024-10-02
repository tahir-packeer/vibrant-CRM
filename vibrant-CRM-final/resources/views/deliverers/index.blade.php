@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Manage Deliverers</h2>

        <a href="{{ route('deliverers.create') }}" class="btn btn-primary mb-3">Assign Deliverer to Order</a>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Deliverers List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-bordered">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Deliverer Name</th>
                                <th>Delivery Status</th>
                                <th>Delivery Note</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deliverers as $deliverer)
                                <tr>
                                    <td>{{ $deliverer->order_id }}</td>
                                    <td>{{ $deliverer->deliverer_name }}</td>
                                    <td>
                                            <span class="badge
                                                @if($deliverer->delivery_status == 'Pending') bg-warning
                                                @elseif($deliverer->delivery_status == 'In Transit') bg-info
                                                @elseif($deliverer->delivery_status == 'Delivered') bg-success
                                                @else bg-danger
                                                @endif">
                                                {{ $deliverer->delivery_status }}
                                            </span>
                                    </td>
                                    <td>{{ $deliverer->delivery_note }}</td>
                                    <td>
                                        <a href="{{ route('deliverers.edit', $deliverer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

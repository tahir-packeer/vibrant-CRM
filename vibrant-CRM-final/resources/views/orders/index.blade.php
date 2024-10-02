@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Manage Orders</h2>

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
                                <th>User Name</th>
                                <th>User Address</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Order Price</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="text-white">{{ $order->id }}</td>
                                    <td class="text-white">{{ $order->user_name }} ({{ $order->user->email }})</td>
                                    <td class="text-white">{{ $order->user_address }}</td>
                                    <td class="text-white">{{ $order->product->name }}</td>
                                    <td class="text-white">{{ $order->product_qty }}</td>
                                    <td class="text-white">{{ $order->order_price }}</td>
                                    <td class="text-white">{{ $order->order_status }}</td>
                                    <td class="text-white">{{ $order->payment_status }}</td>
                                    <td>
                                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

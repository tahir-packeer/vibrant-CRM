@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Manage Products</h2>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Product List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-bordered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Promotion Price</th>
                                <th>Promotion Start</th>
                                <th>Promotion End</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="80" height="80">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="text-white">{{ $product->name }}</td>
                                    <td class="text-white">{{ $product->category_id }}</td>
                                    <td class="text-white">{{ $product->category_name }}</td>
                                    <td class="text-white">{{ $product->item_price }}</td>
                                    <td class="text-white">{{ $product->quantity }}</td>
                                    <td class="text-white">{{ $product->promotion_price }}</td>
                                    <td class="text-white">{{ $product->promotion_start }}</td>
                                    <td class="text-white">{{ $product->promotion_end }}</td>
                                    <td class="text-white">{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
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

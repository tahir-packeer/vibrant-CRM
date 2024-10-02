@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Create New Product</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label text-white">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label text-white">Description</label>
                <textarea name="description" class="form-control" id="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="item_price" class="form-label text-white">Price</label>
                <input type="number" name="item_price" class="form-control" id="item_price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label text-white">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label text-white">Status</label>
                <select name="status" class="form-control" id="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label text-white">Category</label>
                <select name="category_id" class="form-control" id="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white">Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>

            <div class="mb-3">
                <label for="promotion_price" class="form-label text-white">Promotion Price</label>
                <input type="number" name="promotion_price" class="form-control" id="promotion_price" step="0.01">
            </div>
            <div class="mb-3">
                <label for="promotion_start" class="form-label text-white">Promotion Start Date</label>
                <input type="date" name="promotion_start" class="form-control" id="promotion_start">
            </div>
            <div class="mb-3">
                <label for="promotion_end" class="form-label text-white">Promotion End Date</label>
                <input type="date" name="promotion_end" class="form-control" id="promotion_end">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

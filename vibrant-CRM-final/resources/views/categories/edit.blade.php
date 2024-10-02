@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Edit Category</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label text-white">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white">Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label text-white">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $category->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="fabric_type" class="form-label text-white">Fabric Type</label>
                <input type="text" name="fabric_type" class="form-control" id="fabric_type" value="{{ $category->fabric_type }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Manage Categories</h2>

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Category List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="80" height="80">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="text-white">{{ $category->name }}</td>
                                    <td class="text-white">{{ $category->description }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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

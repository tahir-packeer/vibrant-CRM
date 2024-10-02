@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Manage Customizations</h2>

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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>User ID</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customizations as $customization)
                            <tr>
                                <td class="text-white">{{ $customization->title }}</td>
                                <td class="text-white">{{ $customization->description }}</td>
                                <td>
                                    @if($customization->image)
                                        <img src="{{ asset($customization->image) }}" alt="{{ $customization->title }}" width="80" height="80">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td class="text-white">{{ $customization->quantity }}</td>
                                <td class="text-white">{{ $customization->status }}</td>
                                <td class="text-white">{{ $customization->unit_price }}</td>
                                <td class="text-white">{{ $customization->total_price }}</td>
                                <td class="text-white">{{ $customization->user_id }}</td>
                                <td class="text-white">{{ $customization->latitude }}</td>
                                <td class="text-white">{{ $customization->longitude }}</td>
                                <td>
                                    <a href="{{ route('customizations.edit', $customization->id) }}" class="btn btn-sm btn-warning">Edit</a>
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

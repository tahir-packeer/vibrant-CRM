@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Manage Users</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Customer List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="text-white">{{ $customer->name }}</td>
                                    <td class="text-white">{{ $customer->email }}</td>
                                    <td class="text-white">{{ $customer->user_type }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
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

        <!-- Added margin between the two cards -->
        <div class="row mt-4"> <!-- mt-4 adds margin-top -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Admin List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td class="text-white">{{ $admin->name }}</td>
                                    <td class="text-white">{{ $admin->email }}</td>
                                    <td class="text-white">{{ $admin->user_type }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
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

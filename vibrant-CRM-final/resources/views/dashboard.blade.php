@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 text-white" style=" background: linear-gradient(180deg, #d4a017, #c59656, #cda132);">
        <div class="row">
            <div class="col-12 d-flex align-items-center">
                <i class="bi bi-sliders fs-1 me-3"></i>
                <h2 class="mb-0">Admin Dashboard</h2>
            </div>
        </div>
    </div>
    <style>
        .custom-icon {`
            color: #ffffff; /* Custom color */
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Card 1: Category Management -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam fs-1 mb-3 custom-icon"></i>
                        <h5 class="card-title">Product Category Management</h5>
                        <a href="{{ url('/categories') }}" class="btn btn-primary mt-3">Manage Categories</a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Product Management -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <i class="bi bi-cart-plus fs-1 mb-3 custom-icon"></i>
                        <h5 class="card-title">Product Management</h5>
                        <a href="{{ url('/products') }}" class="btn btn-primary mt-3">Manage Products</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: User Management -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 mb-3 custom-icon"></i>
                        <h5 class="card-title">User Management</h5>
                        <a href="{{ url('/users') }}" class="btn btn-primary mt-3">Manage Users</a>
                    </div>
                </div>
            </div>

            <!-- Card 4: Orders Management -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <i class="bi bi-receipt fs-1 mb-3 custom-icon"></i>
                        <h5 class="card-title">Orders Management</h5>
                        <a href="{{ url('/orders') }}" class="btn btn-primary mt-3">Manage Orders</a>
                    </div>
                </div>
            </div>

            <!-- Card 5: Deliverers Management -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <i class="bi bi-truck fs-1 mb-3 custom-icon"></i>
                        <h5 class="card-title">Deliverers Management</h5>
                        <a href="{{ url('/deliverers') }}" class="btn btn-primary mt-3">Manage Deliverers</a>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
@endsection

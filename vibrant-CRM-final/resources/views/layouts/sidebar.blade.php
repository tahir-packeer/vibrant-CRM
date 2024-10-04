<div class="bg-dark-custom sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="sidebar-heading text-center py-4">
            <a href="{{ url('/dashboard') }}" class="text-white text-decoration-none">Admin Dashboard</a>
        </div>
        <ul class="list-unstyled">
            <li>
                <a href="{{ url('/categories') }}" class="nav-link d-flex align-items-center text-white">
                    <i class="bi bi-box-seam me-2"></i> Categories
                </a>
            </li>
            <li>
                <a href="{{ url('/products') }}" class="nav-link d-flex align-items-center text-white">
                    <i class="bi bi-cart-plus me-2"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ url('/users') }}" class="nav-link d-flex align-items-center text-white">
                    <i class="bi bi-people me-2"></i> Users
                </a>
            </li>
            <li>
                <a href="{{ url('/orders') }}" class="nav-link d-flex align-items-center text-white">
                    <i class="bi bi-receipt me-2"></i> Orders
                </a>
            </li>
            <li>
                <a href="{{ url('/deliverers') }}" class="nav-link d-flex align-items-center text-white">
                    <i class="bi bi-truck me-2"></i> Deliverers
                </a>
            </li>
        </ul>
    </div>

    <div class="px-3 py-2">
        <form action="{{ route('logout') }}" method="POST" style="display:inline-block; width: 100%;">
            @csrf
            <button type="submit" class="btn btn-danger" style="width: 100%; padding-left: 20px; padding-right: 20px;">Logout</button>
        </form>
    </div>

</div>

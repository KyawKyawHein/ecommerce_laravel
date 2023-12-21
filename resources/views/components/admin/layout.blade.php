<x-admin.header/>
    <div class="container">
        <div class="row">
            <div class="col-3 d-flex mt-3">
                <ul class="list-group w-100">
                    <li class="list-group-item active" aria-current="true">Admin Dashboard</li>
                    <li class="list-group-item"><a class="text-decoration-none text-dark" href="{{route('admin.category')}}">Category</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none text-dark">Product</a></li>
                    <li class=" list-group-item">
                        <p><a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-dark">Orders</a></p>
                        <a href="{{ route('admin.orders.pending') }}" class="p-2 d-block border me-4">Pending</a>
                        <a href="{{ route('admin.orders.complete') }}" class="p-2 d-block border me-4">Complete</a>
                    </li>
                    {{-- <li class="nav list-group-item">
                        <p><a href="" class="text-dark text-decoration-none">Transaction</a></p>
                        <a href="" class="nav-link border me-4">Add Transaction</a>
                        <a href="" class="nav-link border me-4">Remove Transaction</a>
                    </li> --}}
                </ul>
            </div>
            <div class="col-9 mt-3">
                {{$slot}}
            </div>
        </div>
    </div>
    {{ $script??'' }}
<x-admin.footer/>
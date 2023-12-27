<x-admin.header/>
    <div class="container">
        <div class="row">
            <div class="col-3 d-flex mt-3">
                <ul class="list-group w-100">
                    <li class="list-group-item" aria-current="true"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none {{Route::currentRouteName()==='admin.dashboard'?'text-primary fw-bold':'text-dark'}}">Admin Dashboard</a></li>
                    <li class="list-group-item"><a class="text-decoration-none  {{Route::currentRouteName()==='admin.parent-categories.index'?'text-primary fw-bold':'text-dark'}}" href="{{route('admin.parent-categories.index')}}">Parent Category</a></li>
                    <li class="list-group-item"><a class="text-decoration-none  {{Route::currentRouteName()==='admin.category'?'text-primary fw-bold':'text-dark'}}" href="{{route('admin.category')}}">Category</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none {{Route::currentRouteName()==='admin.products.index'?'text-primary fw-bold':'text-dark'}}">Product</a></li>
                    <li class=" list-group-item">
                        <p><a href="{{ route('admin.orders.index') }}" class="text-decoration-none {{Route::currentRouteName()==='admin.orders.index'?'text-primary fw-bold':'text-dark'}}">Orders</a></p>
                        <a href="{{ route('admin.orders.pending') }}" class="p-2 d-block border me-4 {{Route::currentRouteName()==='admin.orders.pending'?'text-primary fw-bold':''}}">Pending</a>
                        <a href="{{ route('admin.orders.complete') }}" class="p-2 d-block border me-4 {{Route::currentRouteName()==='admin.orders.complete'?'text-primary fw-bold':''}}">Complete</a>
                    </li>
                    <li class="list-group-item mb-2"><a href="{{ route('admin.banners.index') }}" class="text-decoration-none {{Route::currentRouteName()==='admin.banners.index'?'text-primary fw-bold':'text-dark'}}">Banner</a></li>
                    <li class="list-group-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-outline-danger w-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col-9 mt-3">
                {{$slot}}
            </div>
        </div>
    </div>
    {{ $script??'' }}
<x-admin.footer/>

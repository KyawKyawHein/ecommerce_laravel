<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Myanmar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class=" min-vh-100">
    {{-- nav bar  --}}
    <div class="container-fluid container-md">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand text-orange fw-bold" href="{{ route('home') }}">Shop</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item text-center md:text-start">
                                    <a class="nav-link" href="{{ route('categories') }}">Categories</a>
                                </li>
                                @if(auth()->check())
                                <li class="nav-item text-center d-block d-lg-none gap-3 justify-content-center align-items-center">
                                    <a class="nav-link text-center cursor-pointer" href="{{route('addToCart.index')}}">Cart <span id="cartItemCount" class="p-1 py-0 bg-danger rounded rounded-circle text-white">{{ auth()->user()->products()->count() }}</span></a>
                                </li>
                                <li class="nav-item text-center d-block d-lg-none gap-3 justify-content-center align-items-center">
                                    <a href="{{route('orders.index')}}" class="nav-link text-center cursor-pointer" >Ordered Pay Slip <span id="orderItemCount" class="p-1 py-0 bg-danger rounded rounded-circle text-white">{{ auth()->user()->orders()->count() }}</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-center md:text-start dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{auth()->user()->name}}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-center text-lg-start" href="{{ route('accountDetail') }}">Setting</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="post" action="{{route('logout')}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn w-100">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @else
                                    <li class="nav-item text-center">
                                     <a class="nav-link" href="{{route('login')}}">Login</a>
                                    </li>
                                    <li class="nav-item text-center">
                                        <a class="nav-link" href="{{route('register')}}">Register</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="d-none d-lg-flex align-items-center">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" name="search" @if(isset($_GET['search'])) value="{{ $_GET['search'] }}" @endif type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                                @auth
                                <div class="ms-4 position-relative">
                                    <a href="{{route('addToCart.index')}}" class="nav-link mb-0 cursor-pointer" ><i class="fa-solid fa-cart-shopping"></i></a>
                                    <span id="cartItemCount" class="position-absolute cart-item-count rounded rounded-circle px-1 text-light bg-danger">{{ auth()->user()->products()->count() }}</span>
                                </div>
                                <div class="ms-4 position-relative">
                                    <a href="{{route('orders.index')}}" class="nav-link mb-0 cursor-pointer" ><i class="fa-solid fa-ticket"></i></a>
                                    <span id="orderItemCount" class="position-absolute cart-item-count rounded rounded-circle px-1 text-light bg-danger">{{ auth()->user()->orders()->count() }}</span>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    {{-- end nav bar  --}}

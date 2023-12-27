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
</head>
<body class=" min-vh-100">
    {{-- nav bar  --}}
    <div class="container-fluid container-md">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid d-flex align-items-center">
                        <a class="navbar-brand text-orange fw-bold" href="{{ route('home') }}">Shop</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse d-flex justify-content-between align-items-center navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav d-flex align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link aa" href="{{ route('categories') }}">Categories</a>
                                </li>
                                @if(auth()->check())
                                    <li class="nav-item">
                                        <p class="nav-link py-0 m-0">{{auth()->user()->name}}</p>
                                    </li>
                                    <li class="border rounded p-2">
                                        <form method="post" action="{{route('logout')}}">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="nav-link py-0" value="Logout">
                                        </form>
                                    </li>
                                @else
                                    <li class="nav-item">
                                     <a class="nav-link" href="{{route('login')}}">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('register')}}">Register</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="d-none d-md-flex align-items-center">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" name="search" @if(isset($_GET['search'])) value="{{ $_GET['search'] }}" @endif type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                                @auth
                                <div class="ms-4 position-relative">
                                    <a href="{{route('addToCart.index')}}" class="nav-link mb-0 cursor-pointer" ><i class="fa-solid fa-cart-shopping"></i></a>
                                    <span class="position-absolute cart-item-count rounded rounded-circle px-1 text-light bg-danger">{{ auth()->user()->products()->count() }}</span>
                                </div>
                                <div class="ms-4 position-relative">
                                    <a href="{{route('orders.index')}}" class="nav-link mb-0 cursor-pointer" ><i class="fa-solid fa-ticket"></i></a>
                                    <span class="position-absolute cart-item-count rounded rounded-circle px-1 text-light bg-danger">{{ auth()->user()->orders()->count() }}</span>
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

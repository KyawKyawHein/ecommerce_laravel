<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container-fluid container-md">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse d-flex justify-content-between navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Product Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="fa-solid fa-cart-shopping"></i></a>
                            </li>
                            @if(auth()->check())
                                <li class="nav-item">
                                  <p class="nav-link">{{auth()->user()->name}}</p>
                                </li>    
                                <li class="nav-item">
                                  <form method="post" action="{{route('logout')}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="nav-link" value="Logout">
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
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    
@props(['categoriesWithRandomProduct','products','banners'])
<x-user.layout>
    <div class="container-fluid container-md">
        <div class="row justify-content-center" id="category">
            <div class="col-12 ">
                  @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif

                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @foreach ($banners as $key=>$banner)
                            <div class="carousel-item {{ $key==0?'active':'' }}">
                               <img src="{{ asset('assets/image/banners/'.$banner->image) }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <h5 class="mt-3">Categories</h5>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($categoriesWithRandomProduct as $category)
                        <a href="{{ route('productsByCategory',['parentCategory'=>$category['category']->parent_category->slug,'category'=>$category['category']->slug]) }}" class="text-decoration-none">
                            <div class="card category-card p-2 px-3">
                                <div class="card-body p-0">
                                    @if ($category['randomPd'])
                                        <img src="{{ asset('assets/image/products/'.$category['randomPd']->image) }}" width="100px" height="100px" class="rounded" alt="">
                                        @else
                                        <img src="{{ asset('assets/image/products/65826c42328d4.png') }}" width="100px" height="100px" class="rounded" alt="">
                                    @endif
                                    <p class="m-0 mt-2 text-center">{{ $category['category']->name }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-12 mt-5 d-flex flex-column fw-bold justify-content-center mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Just For You</h5>
                    <div>
                        {{$products->links()}}
                    </div>
                </div>
                @if (isset($_GET['search']) && $_GET['search']!='')
                    @if($products->count())
                        <p>{{ $products->count() }} product{{ $products->count()>1? 's':'' }} found.</p>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">All products</a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">All products</a>
                        <h3 class="text-center text-danger">Not found.</p>
                    @endif
                @endif
                <div class="d-flex flex-wrap gap-4">
                @foreach($products as $product)
                    <a href="{{route('product.show',$product->slug)}}" class="text-decoration-none text-dark">
                        <div class="card show-card p-0">
                            <div class="card-body p-2">
                                @if (isset($product->image))
                                    <img src="{{asset('assets/image/products/'.$product->image)}}" class="main-img-card rounded" alt="">
                                @else
                                    <img src="{{asset('assets/product_no_img.jpg')}}" alt="" class="main-img-card rounded">
                                @endif
                                    <p class="">{{$product->name}}</p>
                                <b class="text-primary">{{$product->price}}MMK</b>
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            var myCarousel = document.querySelector('#carousel')
            var carousel = new bootstrap.Carousel(myCarousel)
        </script>
    </x-slot>
</x-user.layout>


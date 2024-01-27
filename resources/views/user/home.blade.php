@props(['categoriesWithRandomProduct','products','banners'])
<x-user.layout>
    <div class="container-fluid container-md">
        <div class="row justify-content-center">
            <div class="col-12 ">
                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif

                {{-- carousel  --}}
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

                {{-- categories  --}}
                <h5 class="mt-3 d-none d-md-block">Categories</h5>
                <div class="d-none d-md-flex flex-wrap gap-2">
                    @foreach ($categoriesWithRandomProduct as $category)
                        <a href="{{ route('productsByCategory',['parentCategory'=>$category['category']->parent_category->slug,'category'=>$category['category']->slug]) }}" class="text-decoration-none">
                            <div class="card category-card p-2 px-3">
                                <div class="card-body p-0">
                                    @if ($category['randomPd'])
                                        <img src="{{ asset('assets/image/products/'.$category['randomPd']->image) }}" width="100px" height="100px" class="rounded" alt="">
                                        @else
                                        <img src="{{ asset('assets/image/products/65826c42328d4.png') }}" width="100px" height="100px" class="rounded" alt="">
                                    @endif
                                    <small class="m-0 mt-2 text-center">{{ $category['category']->name }}</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- products  --}}
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
                <div class="row justify-content-center">
                        @foreach($products as $product)
                            <x-user.product-card :product="$product" />
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script>
            var myCarousel = document.querySelector('#carousel')
            var carousel = new bootstrap.Carousel(myCarousel)
        </script>
    </x-slot>
</x-user.layout>


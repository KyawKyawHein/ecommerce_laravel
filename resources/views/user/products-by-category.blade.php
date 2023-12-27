@props(['products','category'])
<x-user.layout>
    <div class="container-fluid container-md">
        <div class="row">
            <div class="col-12 col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('parentCategory.categories',$category->parent_category->slug) }}">{{ $category->parent_category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                <div class="products-by-category">
                     <div class="col-12 mt-5 d-flex flex-column fw-bold justify-content-center mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h5>{{ $category->name }}</h5>
                                @if ($products->count())
                                        <p>{{ $products->count() }} item{{ $products->count()>1? 's':'' }} found for "<span class="text-orange">{{ $category->name }}</span>"</p>
                                    @else
                                        <h1 class="text-center text-danger fw-bold">Not found</h1>
                                @endif
                            </div>
                            <div>
                                {{$products->links()}}
                            </div>
                        </div>
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
                                            <a href="{{route('product.show',$product->slug)}}" class="text-decoration-none text-dark">
                                                <p class="">{{$product->name}}</p>
                                            </a>
                                            <b class="text-primary">{{$product->price}}MMK</b>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user.layout>

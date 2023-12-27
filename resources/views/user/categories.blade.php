@props(['categories','category_slug'=>'Categories'])
<x-user.layout>
    <div class="container-fluid container-md">
        <div class="row">
            <div class="col-12 col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category_slug->name??$category_slug }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                {{-- <h1 class="fw-bold text-orange my-3">Categories</h1> --}}
                <div class="d-flex flex-wrap gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('productsByCategory',['parentCategory'=>$category['category']->parent_category->slug,'category'=>$category['category']->slug]) }}" class="text-decoration-none">
                        <div class="card show-card p-0">
                            <div class="card-body p-2">
                                @if ($category['randomPd'])
                                    <img src="{{asset('assets/image/products/'.$category['randomPd']->image)}}" class="main-img-card rounded" alt="">
                                @else
                                    <img src="{{ asset('assets/image/products/65826c42328d4.png') }}" class="main-img-card rounded" alt="">
                                @endif
                                <h5 class="text-center mt-2">{{$category['category']->name}}</h5>
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-user.layout>

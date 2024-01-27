@props(['product'])
<a href="{{route('product.show',$product->slug)}}" class="col-12 col-md-4 col-lg-3 text-decoration-none text-dark">
    <div class="card show-card p-0">
        <div class="card-body p-2">
            @if (isset($product->image))
                <img src="{{asset('assets/image/products/'.$product->image)}}" class="main-img-card rounded" alt="">
            @else
                <img src="{{asset('assets/product_no_img.jpg')}}" alt="" class="main-img-card rounded">
            @endif
            <div class="text-center md:text-start">
                <p class="">{{Str::limit($product->name,20,'...')}}</p>
                <b class="text-primary">{{$product->price}}MMK</b>
            </div>
        </div>
    </div>
</a>

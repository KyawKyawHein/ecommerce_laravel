@props(['product'])
<x-user.layout>
    <div class="row justify-content-center align-items-center mt-5">
        <div class="col-12 col-md-8">
            <div class="d-block d-md-flex justify-content-between">
                <div class="">
                    @if (isset($product->image))
                        <img src="{{$product->image}}" alt="">
                    @else
                        <img src="{{asset('assets/product_no_img.jpg')}}" alt="" class="detail-img rounded">
                    @endif
                </div>
                <div class="">
                    <h3 class="">{{$product->name}}</h3>
                    <p class="">{{$product->description}}</p>
                    <div class="">
                        <h5>Quantity</h5>
                        <div class="d-flex">
                            <button class="btn border border-black rounded-0 fw-bold">+</button>
                            <p class="px-3 border border-black rounded-0 fw-bold mb-0 d-flex justify-content-center align-items-center">{{$product->stock_quantity}}</p>
                            <button class="btn border border-black rounded-0 px-3 fw-bold">-</button>
                        </div>
                        <div class="d-flex gap-3 mt-3">
                            <button class="btn btn-outline-dark">Add to cart</button>
                            <button class="btn btn-danger">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex shadow mt-5 p-3">
                <div class="card-body text-center">
                    <h5>Category</h5>
                    <p class="">{{$product->category->name}}</p>
                </div>
                <div class="card-body text-center">
                    <h5>Price</h5>
                    <p class="">{{$product->price}}</p>
                </div>
                <div class="card-body text-center">
                    <h5>In stock</h5>
                    <p class="">{{$product->stock_quantity}}</p>
                </div>
            </div>

            <div class="trending mt-4">
                <h5 class="mb-4">Trending Now</h5>
                <div class="d-block">
                    <div class="">
                        @if (isset($product->image))
                            <img src="{{$product->image}}" alt="">
                        @else
                            <img src="{{asset('assets/product_no_img.jpg')}}" alt="" class="trending-img rounded">
                        @endif
                    </div>
                    <div class="">
                        <h3 class="">{{$product->name}}</h3>
                        <b>{{$product->price}}</b>
                    </div>
            </div>
            </div>
        </div>
    </div>
</x-user.layout>
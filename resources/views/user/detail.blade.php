@props(['product','randomProducts','productCountFromCart'])
<x-user.layout>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('parentCategory.categories',$product->category->parent_category->slug) }}">{{ $product->category->parent_category->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('productsByCategory',['parentCategory'=>$product->category->parent_category->slug,'category'=>$product->category->slug]) }}">{{ $product->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 col-md-10">
                <div class="d-block p-3 d-md-flex justify-content-between gap-5">
                    <div class="">
                        @if (isset($product->image))
                            <img src="{{asset('assets/image/products/'.$product->image)}}" class="rounded" width="300px" alt="">
                        @else
                            <img src="{{asset('assets/product_no_img.jpg')}}" alt="" class="detail-img rounded">
                        @endif
                    </div>
                    <div class="">
                        <h3 class="text-primary">{{$product->name}}</h3>
                        <p class="">{{$product->description}}</p>
                        <div class="">
                            <h5>Quantity</h5>
                            <div class="d-flex">
                                <button id="addQuantity" class="btn border border-black rounded-0 fw-bold">+</button>
                                <p class="detail-item-quantity px-3 user-select-none border border-black rounded-0 fw-bold mb-0 d-flex justify-content-center align-items-center" id="quantity">{{  $productCountFromCart }}</p>
                                <button id="removeQuantity" class="btn border border-black rounded-0 px-3 fw-bold">-</button>
                            </div>
                            <b class="text-danger" id="textAlert"></b>
                            <div class="d-flex gap-3 mt-3">
                                <button id="addToCart" class="btn btn-outline-success">Add to cart</button>
                                <button id="buyProduct" class="btn btn-danger">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex border shadow mt-5 p-3">
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

                @if ($randomProducts->count() >0)
                    <div class="related mt-4">
                        <h5 class="mb-4">Related with {{ $product->category->name }}</h5>
                        <div class="d-flex gap-2 flex-nowrap">
                            @foreach ($randomProducts as $randomProduct)
                                <a href="{{route('product.show',$randomProduct->slug)}}" class="text-decoration-none text-dark">
                                    <div class="card show-card p-0">
                                        <div class="card-body p-2">
                                            <img src="{{ asset('assets/image/products/'.$randomProduct->image) }}" class="main-img-card rounded" alt="">
                                            <p class="m-0 mt-2 text-center">{{ $randomProduct->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <h1 class="text-center mt-3 text-danger fw-bold">No related products.</h1>
                @endif
            </div>
        </div>
    </div>
    <x-slot:script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                $('#addQuantity').on('click',function(){
                    addQuantity();
                })
                 $('#removeQuantity').on('click',function(){
                    removeQuantity();
                })
                $('#addToCart').on('click',function(){
                    addToCart();
                });
                $('#buyProduct').on('click',function(){
                    buyProduct();
                });
            })

            function addQuantity(){
                let selectedQuantity = parseInt($('#quantity').text());
                let availableQuantity = {{ $product->stock_quantity }};

                if(selectedQuantity <0 ){
                    alert('Invalid quantity');
                }else if(selectedQuantity >= availableQuantity){
                    alert(`Sorry,stock is only ${availableQuantity} left.`);
                }else{
                    let addQuantity = selectedQuantity+1;
                    $('#quantity').text(addQuantity);
                }
            }
            function removeQuantity(){
                let selectedQuantity = parseInt($('#quantity').text());
                let availableQuantity = {{ $product->stock_quantity }};

                if(selectedQuantity <=0 ){
                    alert('Invalid quantity');
                }else{
                    let removeQuantity = selectedQuantity-1;
                    $('#quantity').text(removeQuantity);
                }
            }
            function addToCart(){
                let selectedQuantity = parseInt($('#quantity').text());
                @auth
                    if(selectedQuantity <1){
                        alert('Please add quantity first.');
                    }else{
                        let data = {
                            product_id : {{ $product->id }},
                            quantity : parseInt($('#quantity').text())
                        };
                        axios.post("{{ route('addToCart') }}",data)
                        .then(({data})=>{
                            console.log(data);
                            $("#textAlert").text("Products is added.");
                            $('.cart-item-count').text(data.cartCount);
                        })
                        .catch((error)=>console.log(error));
                    }
                @else
                    window.location.href = "{{ route('login') }}";
                @endauth
            }
            function buyProduct(){
                let selectedQuantity = parseInt($('#quantity').text());
                @auth
                    if(selectedQuantity <1){
                        alert('Please add quantity first.');
                    }
                @else
                    window.location.href = '{{ route('login') }}';
                @endauth
            }
        </script>
    </x-slot>
</x-user.layout>

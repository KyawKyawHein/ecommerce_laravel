@props(['products'])
<x-user.layout>
    <div class="container-fluid container-md">
        <div class="row justify-content-center align-items-center mt-3">
            <div id="productsInCart" class="col-12 col-md-10">
                <p id="error" class="d-none p-3 alert alert-danger"></p>
                @if ($products->count())
                <div class="table-responsive">
                    <table class="table" id="cartRole">
                        <thead>
                            <tr>
                                <th scope="col" class="d-none d-md-block">Product</th>
                                <th scope="col">Image</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key=>$product)
                                <tr class="table-row" data-role-id="{{ $key }}">
                                    <td class="cart-product-name">{{ Str::substr($product->name, 0, 70) }}...</td>
                                    <td>
                                        <img src="{{ asset('assets/image/products/'.$product->image) }}" width="100px" height="100px" class="rounded" alt="">
                                    </td>
                                    <td class="product-quantity">{{ $product->pivot->quantity }}</td>
                                    <td class="product-price">
                                        {{ $product->price * $product->pivot->quantity }}
                                    </td>
                                    <td class="product-controller">
                                        <button data-product="{{ $product->id }}" class="add-quantity btn btn-sm btn-primary">+</button>
                                        <button data-product="{{ $product->id }}" class="remove-quantity btn btn-sm btn-warning">-</button>
                                        <button data-product="{{ $product->id }}" class="remove-product btn btn-sm btn-danger">remove</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-end h5">Total :</td>
                                <td class="cart-total fw-bold h5">{{ auth()->user()->products->sum(fn($p)=>($p->price*$p->pivot->quantity)) }}</td>
                                <td>
                                    <form method="post" action="{{ route('addOrder') }}">
                                        @csrf
                                        <button class="text-decoration-none btn btn-success">Buy</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                    <h1 class="text-danger text-center fw-bold my-5">There is no product in cart.</h1>
                @endif
            </div>
        </div>
    </div>

    <x-slot:script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            let products =  @json($products);
            $(document).ready(function(){
                $('.add-quantity').click(function(){
                    let productController= $(this).closest('.product-controller');
                    let product_id = $(this).data('product');
                    let price = products.filter((p)=>p.id==product_id)[0].price;
                    let data = {
                        product_id : product_id,
                    }
                    axios.post("{{ route('addToCart.increaseQuantity') }}",data)
                    .then(({data})=>{
                        console.log(data);
                        $('#error').addClass('d-none');
                        // change quantity
                        productController.siblings('.product-quantity').text(data.quantity);
                        let updatePrice = data.quantity * price;
                        // change price
                        productController.siblings('.product-price').text(updatePrice);
                        // change total
                        $('.cart-total').text(data.totalAmount)
                    })
                    .catch((error)=>{
                        if(error.response){
                            $('#error').removeClass('d-none');
                            $('#error').text(error.response.data.error);
                        }
                    });
                });
                 $('.remove-quantity').click(function(){
                    let productController= $(this).closest('.product-controller');
                    let product_id = $(this).data('product');
                    let price = products.filter((p)=>p.id==product_id)[0].price;
                    let data = {
                        product_id : product_id,
                    }
                    axios.post("{{ route('addToCart.decreaseQuantity') }}",data)
                    .then(({data})=>{
                        console.log(data);
                        $('#error').addClass('d-none');
                        // change quantity
                        productController.siblings('.product-quantity').text(data.quantity);
                        let updatePrice = data.quantity * price;
                        // change price
                        productController.siblings('.product-price').text(updatePrice);
                        //change total
                        $('.cart-total').text(data.totalAmount)
                    })
                    .catch((error)=>{
                        console.log(error);
                        if(error.response){
                            $('#error').removeClass('d-none');
                            $('#error').text(error.response.data.error);
                        }
                    });
                });

                $('.remove-product').click(function(){
                    let product_id = $(this).data('product');
                    let productRow = $(this).closest('.table-row');
                    axios.post("{{ route('cart.removeProduct') }}",{product_id})
                    .then(({data})=>{
                        console.log(data);
                        productRow.remove();
                        //change total
                        $('.cart-total').text(data.totalAmount)
                        $('#cartItemCount').text(data.cartProductQuantity);
                        if(data.cartProductQuantity==0){
                            $('#productsInCart').html(`
                            <h1 class="text-danger text-center fw-bold my-5">There is no product in cart.</h1>
                            `)
                        }
                    })
                    .catch((err)=>console.log(err))
                });
            });
        </script>
    </x-slot>
</x-user.layout>

@props(['products'])

<x-admin.layout>
    <div class="">
        <h3 class="text-primary">All Products</h3>
        @if (session('success'))
            <p class="alert alert-success">{{session('success')}}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-success">{{session('error')}}</p>
        @endif
        <a href="{{route('admin.products.create')}}" class="btn btn-primary">Add Product</a>
        @if(count($products) >0)
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Category</th>
                    <th scope="col">View</th>
                    <th scope="col">Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key=>$product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{Str::limit($product->description,20).'...'}}</td>
                        <td>
                            <img src="{{ asset('assets/image/products/'.$product->image) }}" width="150px" alt="img">
                        </td>
                        <td>{{ $product->price }} <b>MMK</b></td>
                        <td class="text-center">{{ $product->stock_quantity }}</td>
                        <td class="text-center">{{ $product->category->name }}</td>
                        <td class="text-center">{{ $product->view_count }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit',$product->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy',$product->slug) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                {{ $products->links() }}
            </div>
        @else
            <h3 class="mt-5 text-center text-danger">There is no products.</h1>
        @endif
    </div>
</x-admin.layout>

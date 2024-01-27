@props(['orders'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary">All Orders</h3>
        @if (session('success'))
            <p class="alert alert-success">{{session('success')}}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-success">{{session('error')}}</p>
        @endif

        @if (count($orders) >0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key=>$order)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{ $order->user->name }}</td>
                        <td>{{$order->product->name}}</td>
                        <td>
                            <img src="{{ asset('assets/image/products/'.$order->product->image) }}" width="150px" alt="">
                        </td>
                        <td>{{$order->quantity}}</td>
                        <td>{{ $order->address }}</td>
                        <td>
                            @if($order->status == 'pending')
                            <a href="{{ route('admin.orders.makeComplete',$order->id) }}"
                                class="btn btn-outline-primary btn-sm">Make success</a>
                            <span class="badge bg-danger">{{ $order->status }}</span>
                            @else
                            <span class="badge bg-success">{{ $order->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                {{ $orders->links() }}
            </div>
        @else
            <h2 class="mt-5 text-center text-danger">There is no orders.</h2>
        @endif
    </div>
</x-admin.layout>

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
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key=>$order)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$order->product->name}}</td>
                        <td>
                            <img src="{{ asset('assets/image/orders/'.$order->product->image) }}" width="150px" alt="">
                        </td>
                        <td>{{$order->quantity}}</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-danger">{{ $order->status }}</span>
                                <a href="{{ route('admin.orders.makeComplete',$order->id) }}" class="btn btn-outline-primary btn-sm">Make success</button>
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
    </div>
</x-admin.layout>
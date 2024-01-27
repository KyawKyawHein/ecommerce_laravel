@props(['orders'])
<x-user.layout>
    <div class="container-fluid container-md">
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-12 col-md-8">
                <table class="table" id="cartRole">
                    <thead>
                        <tr class="aa">
                            <th scope="col" class="d-none d-md-block">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="table-row">
                                <td class="d-none d-md-block">{{ $order->product->name }}</td>
                                <td>
                                    <img src="{{ asset('assets/image/products/'.$order->product->image) }}" width="100px" height="100px" class="rounded" alt="">
                                </td>
                                <td class="order-quantity">{{ $order->quantity }}</td>
                                <td class="order-price">
                                    {{ $order->product->price * $order->quantity }}
                                </td>
                                <td class="order-status">
                                    @if ($order->status == "pending")
                                        <span class='badge bg-danger'>Pending</span>
                                    @else
                                        <span class='badge bg-success'>On Way</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-user.layout>

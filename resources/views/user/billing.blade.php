<x-user.layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('addOrder') }}" method="post">
                    @csrf
                    <h2 class="text-primary">Address for delivery</h1>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" placeholder="Enter your address" id="address" cols="30" rows="3" class="form-control"></textarea>
                        @error('address')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <small class="text-danger fw-bold d-block my-2">This app is currently get cash on delivery.</small>
                    <div class="text-end">
                        <button class="text-decoration-none btn btn-primary">Order Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.layout>

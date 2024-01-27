<x-user.layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h3 class="mt-3 text-primary">Register</h3>
                <form method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="address">Your address</label>
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="passwordConfirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirm Password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <p class="">Already have an account? <a href="{{route('login')}}">Log in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.layout>
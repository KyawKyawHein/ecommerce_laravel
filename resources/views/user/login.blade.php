<x-user.layout>
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h3 class="mt-3 text-primary">Login</h3>
                <form method="post">
                    @csrf
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <div class="form-group mb-2">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        @error('email')
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
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Log in</button>
                        <p>New User? <a href="{{route('register')}}">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.layout>
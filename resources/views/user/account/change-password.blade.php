@props(['currentUser'])
<x-user.layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accountDetail') }}">Acount Detail</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-6">
                <h3 class="mt-3 text-primary">Change Password</h3>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <form method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                        @error('password')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Enter your confirm password.">
                        @error('password')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success btn-sm">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.layout>


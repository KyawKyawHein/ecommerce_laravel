@props(['currentUser'])
<x-user.layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accountDetail') }}">Acount Detail</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Profile Info</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-6">
                <h3 class="mt-3 text-primary">Change Profile Info</h3>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <form method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $currentUser->name }}" placeholder="Enter name">
                        @error('name')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email address</label>
                        <input type="email" disabled name="email" class="form-control" id="email" value="{{ $currentUser->email }}" placeholder="Enter email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="address">Your address</label>
                        <textarea name="address" id="address" cols="30" class="form-control" rows="5" value="{{ $currentUser->address }}">{{ $currentUser->address }}</textarea>
                        @error('address')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password to change.">
                        @error('password')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success btn-sm">Change info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.layout>


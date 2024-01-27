@props(['currentUser'])
<x-user.layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h3 class="mt-3 text-primary">Your Profile</h3>
                <form method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" disabled name="name" class="form-control" id="name" value="{{ $currentUser->name }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" disabled value="{{ $currentUser->email }}">
                    </div>
                    @if ($currentUser->address)
                         <div class="form-group mb-2">
                            <label for="address">Your address</label>
                            <textarea name="address" id="address" cols="30" class="form-control" disabled rows="5">{{ $currentUser->address }}</textarea>
                        </div>
                    @endif
                    <div class="">
                        <a href="{{ route('changeInfo') }}" class="btn btn-success btn-sm me-2">Change info</button>
                        <a href="{{ route('changePassword') }}">Change password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.layout>


@props(['parentCategory'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary">Edit <span class="fw-bold text-danger">{{ $parentCategory->name }}</span></h3>
        <form action="{{ route('admin.parent-categories.update',$parentCategory->id) }}" method="post">
            @csrf
            @method('put')
                <div class="form-group mb-2">
                    <label for="name">Parent category name</label>
                    <input type="text" class="form-control" value="{{ $parentCategory->name }}" name="name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-end">
                    <button class="btn btn-primary">Update parent category</button>
                </div>
        </form>
    </div>
</x-admin.layout>
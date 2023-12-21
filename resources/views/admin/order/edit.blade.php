@props(['category'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary">Edit <span class="fw-bold text-danger">{{ $category->name }}</span></h3>
        <form action="{{ route('admin.category.update',$category->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="form-group mb-2">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" value="{{ $category->name }}" name="name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="image">Category image</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ asset('assets/image/categories/'.$category->image) }}" class="mt-2" width="200px" alt="">
                </div>
                <div class="text-end">
                    <button class="btn btn-primary">Update Category</button>
                </div>
        </form>
    </div>
</x-admin.layout>
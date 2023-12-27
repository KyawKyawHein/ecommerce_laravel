@props(['parentCategories'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary mb-4">Create Category</h3>
        <form action="{{route('admin.category.store')}}" method="post">
            @csrf
            <div class="form-group">
                <div class="form-group mb-2">
                    <label for="name">Parent Category</label>
                    <select class="form-select" name="parent_category" aria-label="Default select example">
                        <option selected disabled>Select Parent Category</option>
                        @foreach ($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>                            
                        @endforeach
                    </select>
                    @error('parent_category')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="name">Category name</label>
                    <input type="text" name="name" class="form-control" >
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="text-end mt-3">
                <button class="btn btn-primary">Create Category</button>
            </div>
        </form>
    </div>
</x-admin.layout>
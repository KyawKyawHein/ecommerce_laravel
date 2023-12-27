<x-admin.layout>
    <div class="">
        <h3 class="text-primary mb-4">Create Parent Category</h3>
        <form action="{{route('admin.parent-categories.store')}}" method="post">
            @csrf
            <div class="form-group">
                <div class="form-group mb-2">
                    <label for="name">Parent Category Name</label>
                    <input type="text" name="name" class="form-control" >                  
                </div>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-end mt-3">
                <button class="btn btn-primary">Create Parent Category</button>
            </div>
        </form>
    </div>
</x-admin.layout>
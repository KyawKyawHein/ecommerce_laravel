<x-admin.layout>
      <div class="">
        <a href="{{route('admin.banners.index')}}" class="btn btn-primary">All Banner</a>
        <h3 class="text-primary mb-4">Create Banner</h3>
        <form action="{{route('admin.banners.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-group mb-2">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="url">Url</label>
                    <input type="url" name="url" id="url" class="form-control">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="expire">Expire Date</label>
                    <input type="date" name="expire_date" id="expire" class="form-control">
                    @error('expire_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="text-end mt-3">
                <button class="btn btn-primary">Create Banner</button>
            </div>
        </form>
    </div>
</x-admin.layout>

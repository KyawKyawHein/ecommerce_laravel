@props(['product','categories','parentCategories'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary">Edit <span class="fw-bold text-danger">{{ $product->name }}</span></h3>
       <form action="{{route('admin.products.update',$product->slug)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <div class="form-group mb-2">
                    <label for="name">Product name</label>
                    <input type="text" value="{{ $product->name }}" name="name" class="form-control" >
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="description">Product Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="image">Product image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @if($product->image)
                        <img src="{{ asset('assets/image/products/'.$product->image) }}" width="200px" alt="">
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="parentCategory">Parent Category</label>
                    <select name="parent_category_id" id="parentCategory" class="form-control">
                        <option value="" disabled selected>Select main category</option>
                        @foreach ($parentCategories as $category)
                            <option value="{{ $category->id }}" {{ $category->id==$product->category_id? 'selected':'' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2" id="childCategoryContainer">
                    <label for="childCategory">Category</label>
                    <select name="category_id" id="childCategory" class="form-control">
                        {{-- put data from axios  --}}
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="price">Price <span class="text-danger">* You can't change.</span></label>
                    <input type="number" value="{{ $product->price }}" name="price" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="quantity">Quantity <span class="text-danger">* You can't change.</span></label>
                    <input type="number" value="{{ $product->stock_quantity }}" name="stock_quantity" class="form-control">
                </div>
            </div>
            <div class="text-end mt-3">
                <button class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>
    <x-slot:script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                $('#childCategoryContainer').hide();

                // handle change event on the parent category 
                $('#parentCategory').change(function(){
                    let selectedValue = $(this).val();

                     //Make an Ajax request to get the child category based on the parent category
                    axios.post('/admin/get-child-categories',{
                        parent_category_id:selectedValue
                    })
                    .then(({data})=>{
                        console.log(data);
                        $('#childCategory').empty();
                        data.map((category)=>{
                            $('#childCategory').append(`<option value="${category.id}">${category.name}<option/>`);
                        })
                    })
                    .catch((error)=>console.error(error));
                })
            })
        </script>
    </x-slot>
</x-admin.layout>
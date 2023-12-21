@props(['categories'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary">All Categories</h3>
        @if (session('success'))
            <p class="alert alert-success">{{session('success')}}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-success">{{session('error')}}</p>
        @endif
        <a href="{{route('admin.category.create')}}" class="btn btn-primary">Add Category</a>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Parent Category</th>
                <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key=>$category)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->parent_category->name}}</td>
                        <td>
                            <a href="{{route('admin.category.edit',$category->slug)}}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{route('admin.category.destroy',$category->slug)}}" method="post" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            {{ $categories->links() }}
        </div>
    </div>
</x-admin.layout>
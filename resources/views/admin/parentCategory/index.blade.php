@props(['parentCategories'])
<x-admin.layout>
    <div class="">
        <h3 class="text-primary">All Parent Categories</h3>
        @if (session('success'))
            <p class="alert alert-success">{{session('success')}}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-success">{{session('error')}}</p>
        @endif
        <a href="{{route('admin.parent-categories.create')}}" class="btn btn-primary">Add Parent Category</a>
        @if (count($parentCategories) >0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parentCategories as $key=>$category)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{route('admin.parent-categories.edit',$category->id)}}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{route('admin.parent-categories.destroy',$category->id)}}" method="post"
                                class="d-inline-block">
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
                {{ $parentCategories->links() }}
            </div>
        @else
            <h2 class="mt-5 text-center text-danger">There is no Parent Category.</h2>
        @endif
    </div>
</x-admin.layout>

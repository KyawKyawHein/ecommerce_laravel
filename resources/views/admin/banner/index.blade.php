@props(['banners'])
<x-admin.layout>
      <div class="">
        <h3 class="text-primary">All Banners</h3>
        @if (session('success'))
            <p class="alert alert-success">{{session('success')}}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-success">{{session('error')}}</p>
        @endif
        <a href="{{route('admin.banners.create')}}" class="btn btn-primary">Add Banner</a>
        @if (count($banners)>0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Expire Date</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $key=>$banner)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td><img src="{{asset(" assets/image/banners/$banner->image")}}" width="150px" alt=""></td>
                        <td>{{$banner->expire_date}}</td>
                        <td><a href="{{$banner->url}}">{{$banner->url}}</a></td>
                        <td class="fw-bold {{ $banner->status==" Active"?'text-primary':'text-danger' }}">{{ $banner->status }}</td>
                        <td>
                            <form action="{{route('admin.banners.destroy',$banner->id)}}" method="post" class="d-inline-block">
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
                {{ $banners->links() }}
            </div>
        @else
        <h2 class="mt-5 text-center text-danger">There is no banners.</h2>
        @endif
    </div>
</x-admin.layout>

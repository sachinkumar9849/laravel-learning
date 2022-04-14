<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @endif
                    <div class="card-header">Brands</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($brands as $brand)
                            <tr>
                                <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                <td> {{$brand->brand_name}} </td>
                                <td> <img src="{{asset($brand->brand_image)}}" alt="img" style="height: 40px;width:40px"> </td>

                                <td>
                                    @if($brand->created_at == NULL)
                                    <span class="text-danger">No Date set</span>
                                    @else
                                    {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href=" {{ url('brand/edit/'.$brand->id)}} " class="btn btn-info">Edit</a>
                                    <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$brands->links()}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                        <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control">
                                @error('brand_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand Image</label>
                                <input type="file" name="brand_image" class="form-control">
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRACH DATA START  -->

    </div>
</x-app-layout>
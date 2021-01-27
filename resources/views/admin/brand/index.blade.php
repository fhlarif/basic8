@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">

        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <div class="card-header">All Brand</div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               {{--  @php
                                    $i=1
                                @endphp --}}
                                @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px;" alt="{{ $brand->brand_name }}">
                                       {{-- QB  {{ $category->name }} --}}
                                    </td>
                                    <td>
                                        @if ($brand->created_at ==NULL)
                                        <span class="text-danger">No Date Set</span>
                                            
                                        @else
                                        {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }} 
                                        @endif
                                       </td>
                                       <td><a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('brand/softdelete/'.$brand->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>    
                                @endforeach
                                

                            </tbody>
                        </table>
                        {{ $brands->links() }}

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>

                        <div class="card-body">
                            <form action="{{ route('add.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">

                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">

                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>



                    </div>
                </div>

            </div>
        </div>

                {{-- Trash List--}}
                <div class="container">
                    <div class="row">
        
                        <div class="col-md-8">
                            <div class="card">
        
        
                                <div class="card-header" style="color: red;">Thrash List</div>
        
        
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Brand Name</th>
                                            <th scope="col">Brand Image</th>
                                            <th scope="col">Deleted At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       {{--  @php
                                            $i=1
                                        @endphp --}}
                                        @foreach ($trashBrands as $brand)
                                        <tr>
                                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td><img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px;" alt="{{ $brand->brand_name }}">
                                               {{-- QB  {{ $category->name }} --}}
                                            </td>
                                            <td>
                                                @if ($brand->deleted_at ==NULL)
                                                <span class="text-danger">No Date Set</span>
                                                    
                                                @else
                                                {{ Carbon\Carbon::parse($brand->deleted_at)->diffForHumans() }} 
                                                @endif
                                               </td>
                                               <td><a href="{{ url('brand/restore/'.$brand->id) }}" class="btn btn-info">Restore</a>
                                                <a href="{{ url('brand/pdelete/'.$brand->id) }}" class="btn btn-danger" onclick=" return confirm('Are you sure to permanently delete this item?')" >Permanent Delete</a>
                                            </td>
                                        </tr>    
                                        @endforeach
                                        
        
                                    </tbody>
                                </table>
                                {{ $trashBrands->links() }}
        
                            </div>
                        </div>
        
                        <div class="col-md-4">
                    
                        </div>
        
                    </div>
                </div>
                {{-- End Thrash List --}}


    </div>

    @endsection

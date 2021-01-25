<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Pic
        </h2>
    </x-slot>

    <div class="py-12">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">

                        @foreach($multipic as $image)
                            <div class="col-md-4 mt-3 px-3">
                                <div class="card">
                                    <img src="{{ asset($image->image) }}" alt="No Image">
                                        <a href="{{ url('multipic/softdelete/'.$image->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $multipic->links() }}
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Pic</div>

                        <div class="card-body">
                            <form action="{{ route('add.multipic') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                    <input type="file" name="multipic[]" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" multiple="">

                                    @error('multipic')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </form>
                        </div>

                         {{-- Trash List--}}
                <div class="container">
                    <div class="row">
                       
        
       
                  
        
        
                               
                             
                                <table class="table "> 
                                    Trash List
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Brand Image</th>
                                            <th scope="col">Deleted At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       {{--  @php
                                            $i=1
                                        @endphp --}}
                                        @foreach ($trashmultipic as $image)
                                        <tr>
                                            <th scope="row">{{ $multipic->firstItem()+$loop->index }}</th>
                                            <td><img src="{{ asset($image->image) }}" style="height:70px; width:100px;" alt="Failed to load image">
                                               {{-- QB  {{ $category->name }} --}}
                                            </td>
                                            <td>
                                                @if ($image->deleted_at ==NULL)
                                                <span class="text-danger">No Date Set</span>
                                                    
                                                @else
                                                {{ Carbon\Carbon::parse($image->deleted_at)->diffForHumans() }} 
                                                @endif
                                               </td>
                                               <td><a href="{{ url('multipic/restore/'.$image->id) }}" class="btn btn-info" style="margin-bottom: 8px;">Restore</a>
                                                <a href="{{ url('multipic/pdelete/'.$image->id) }}" class="btn btn-danger" onclick=" return confirm('Are you sure to permanently delete this item?')" >Permanent Delete</a>
                                            </td>
                                        </tr>    
                                        @endforeach
                                        
        
                                    </tbody>
                                </table>
                                {{ $trashmultipic->links() }}
        
                        </div>
        
           
                </div>
                {{-- End Thrash List --}}



                    </div>
                </div>

            </div>
        </div>



    </div>
</x-app-layout>
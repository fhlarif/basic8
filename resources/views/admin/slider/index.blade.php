@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h2 style="margin-bottom: 13px;">Home Slider</h2>
                
                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                       
                        <div class="card-header">All Slider</div>
                        <a href=""><button class="btn btn-info">Add Slider</button></a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Slider Title</th>
                                    <th scope="col">Slider Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               {{--  @php
                                    $i=1
                                @endphp --}}
                                @foreach ($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img src="{{ $slider->image}}" style="height:40px; width:70px;" alt="{{ $slider->title }}">
                                    </td>
                            
                                       <td><a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('slider/softdelete/'.$slider->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>    
                                @endforeach
                                

                            </tbody>
                        </table>
                        {{ $sliders->links() }}
            

                    </div>
                </div>

                

            </div>
        </div>



    </div>

    @endsection

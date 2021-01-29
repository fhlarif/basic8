@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h2 style="margin-bottom: 13px;">Home About</h2>

                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                       
                        <div class="card-header">All About</div>
                        <a href="{{ route('add.about') }}"><button class="btn btn-info">Add About</button></a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col"width="15%">About Title</th>
                                    <th scope="col"width="25%">Short Description</th>
                                    <th scope="col"width="15%">Long Description</th>
                                    <th scope="col"width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($homeabout as $homeabout)
                                <tr>
                                    <th scope="row">{{ $i++}}</th>
                                    <td>{{ $homeabout->title }}</td>
                                    <td>{{ $homeabout->short_desc }}</td>
                                    <td>{{ $homeabout->long_desc }}</td>
                            
                                       <td><a href="{{ url('edit/about/'.$homeabout->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('delete/about/'.$homeabout->id) }}" class="btn btn-danger" onclick="return confirm('Aru you sure you want to delete it?')">Delete</a>
                                    </td>
                                </tr>    
                                @endforeach
                                

                            </tbody>
                        </table>
                       {{--  {{ $sliders->links() }} --}}
            

                    </div>
                </div>

                

            </div>
        </div>



    </div>

    @endsection

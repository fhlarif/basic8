@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h2 style="margin-bottom: 13px;">Contact Page</h2>

                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                       
                        <div class="card-header">All Contacts</div>
                        <a href="{{ route('add.about') }}"><button class="btn btn-info">Add Contact</button></a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col"width="15%">Address</th>
                                    <th scope="col"width="25%">Email</th>
                                    <th scope="col"width="15%">Phone</th>
                                    <th scope="col"width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($contacts as $contact)
                                <tr>
                                    <th scope="row">{{ $i++}}</th>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                            
                                       <td><a href="{{ url('edit/contact/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('delete/contact/'.$contact->id) }}" class="btn btn-danger" onclick="return confirm('Aru you sure you want to delete it?')">Delete</a>
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

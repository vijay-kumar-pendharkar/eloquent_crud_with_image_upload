@extends('layouts.app')

@section('title', 'Create Users')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
            
                <h3 class="text-center mb-2">User Form</h3>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('users.update',$users->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="">Name</label>
                        <input type="text" value="{{ $users->name }}" name="name"class="form-control"  placeholder="Enter Name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="Email">Email</label>
                        <input type="email" value="{{ $users->email }}" name="email"class="form-control"  placeholder="Enter Email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="mobile">Mobile</label>
                        <input type="number" min="0" value="{{ $users->mobile }}" name="mobile"class="form-control"  placeholder="Enter mobile">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="Email">Address</label>
                        <input type="texr" value="{{ $users->address }}" name="address"class="form-control"  placeholder="Enter Address">
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="mb-6">
                                <label class="form-label" for="image">Image</label>
                                <input type="file" name="image"class="form-control"  placeholder="Enter Image">
                            </div>
                            <div class="mb-6">
                                <label class="form-label"></label>
                                <img src="{{ asset($users->image) }}" width="80" height="80">
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="document">Document</label>
                                <input type="file" name="document"class="form-control" accept="application/pdf"  placeholder="Enter document">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label"></label>
                                <img src="{{ asset($users->document) }}" width="80" height="80">
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="mb-3">
                        <button class="btn btn-success" name="submit" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
    @endsection
@extends('layouts.app')

@section('title','users')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="d-flex justify-content-end my-4">
                <a class="btn btn-primary" href="{{route('users.create') }}">Create User</a>
            </div>

            <table class="table table-bordered">
                <tr>
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>document</th>
                        <th>Action</th>
                    </thead>
                </tr>
                <tr>
                    @foreach ($users as $index => $user)
                    <tbody>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <img src="{{ asset($user->image) }}" width="80" height="80">
                        </td>
                        <td> <img src="{{ asset($user->document) }}" width="80" height="80"></td>
                        <td>
                            <a class="btn btn-success" href="{{ route('users.edit',$user->id)}}" >Edit</a>
                            &nbsp;
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                     Delete
                                </button>
                            </form>
                        </td>
                    </tbody>
                    @endforeach
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
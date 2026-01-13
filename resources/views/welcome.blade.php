
@extends('layouts.app')

@section('title','app')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="d-flex justify-content-end mt-5">
                 <a class="btn btn-primary" href="{{ route('users.index') }}">user</a>
            </div>
        </div>
    </div>
</div>
@endsection
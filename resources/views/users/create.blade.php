@extends('layouts.app')
@section('title')
    Add New User
@endsection
@section('content')
@section('toolbar')
    <div class="d-flex align-items-center me-3">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3"> Add New User</h1>
        <span class="h-20px border-gray-200 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{route('users.index')}}" class="text-muted text-hover-primary">Users</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark"> Add New User</li>
        </ul>
    </div>
@endsection

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Add New User
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-warning" href="{{route('users.index')}}">Back To Users</a>

        </div>
    </div>
    <!--begin::Form-->


    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
        @include('layouts.includes.alerts.errors')
        @include('layouts.includes.alerts.success')
        @csrf

        <div class="card-body ">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email"  class="form-control">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Save</button>
                     <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection

@extends('layouts.auth.login')
@section('content')

    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
          id="kt_sign_in_form" action="{{route('admin.postLogin')}}" method="post">
        @csrf


        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Login to Dashboard</h1>

        </div>
        @include('layouts.includes.alerts.errors')
        @include('layouts.includes.alerts.success')

        <div class="fv-row mb-10 fv-plugins-icon-container has-danger">
            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
            <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                   autocomplete="off">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>

        <div class="fv-row mb-10 fv-plugins-icon-container">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
            </div>

            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                   autocomplete="off">

            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group row">
            <fieldset>
                <input type="checkbox" name="remember_me" id="remember-me"
                       class="chk-remember">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Remember me</label>
            </fieldset>

            <button type="submit" id="" class="btn btn-lg btn-primary fw-bolder me-3 my-2">
                <span class="indicator-label">Login</span>
                <span class="indicator-progress">Loading ...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>

        </div>
        <div></div>
    </form>
@endsection

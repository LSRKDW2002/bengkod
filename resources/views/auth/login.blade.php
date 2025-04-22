@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                </div>
            </div>
            <div class="col-5">
                <button type=submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    @if(Route::has('password.request'))
        <p class="my-0">
            <a href="{{ route('password.request') }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif
    @if(Route::has('register'))
        <p class="my-0">
            <a href="{{ route('register') }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif
@stop
@extends('layouts.app')
@section('title', 'Recover your password')
@section('content')

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" class="needs-validation" action="{{ route('password.email') }}">
                    @csrf
                    <div class="text-center">
                        <img src="{!! asset('assets/images/logo/logo.png') !!}" alt="logo.png" class="img img-responsive" width="300px">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">

                                <div class="col-md-12">
                                    <h3 class="text-primary">Recover your password</h3>
                                </div>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" placeholder="Enter Email ID" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20 btnSubmit">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-inverse text-left">
                                        <a href="{{ route('index') }}">
                                            <b class="f-w-600">Back to website</b>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection
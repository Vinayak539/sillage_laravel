@extends('layouts.master')
@section('title','Forget Password')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Forget Password</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Forget Password</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div class="signUp-page signUp-minimal">
    <div class="signin-form-wrapper">
        <div class="title-area text-center">
            <h3>Recover your password</h3>
        </div> <!-- /.title-area -->
        <form id="login-form" method="POST" autocomplete="off" class="needs-validation">
            <input type="hidden" name="_token" value="VUd7GU3HstuDMKODoTdUH3JETKDiopD28amJOVgD">
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" name="email" id="email" value="" required autofocus>
                        <label>Email *</label>
                    </div> <!-- /.input-group -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->

            <button type="submit" class="line-button-one button-rose button_update">Submit</button>
        </form>
    </div> <!-- /.sign-up-form-wrapper -->
</div> <!-- /.signUp-page -->


@endsection
@extends('layouts.master')
@section('title','My Account')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">My Account</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="current"><span>My Account</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<section class="main_content_area">
    <div class="container">
        <div class="account_dashboard">
            <div class="row">
                <div class="login">
                    <div class="login_form_container">
                        <div class="account_login_form">
                            <form class="form" method="POST" action="{{ route('user.profile.updateRequest') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Email ID <span class="text-d">*</span></label>
                                        <input class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input id="name" type="text" name="name" placeholder="Name*"
                                            value="{{ $user->name }}" required="required"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Mobile Number <span class="text-danger">*</span></label>
                                        <input id="mobile" type="text" name="mobile"
                                            placeholder="Mobile Number*" value="{{ $user->mobile }}"
                                            required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Town/City <span class="text-danger">*</span></label>
                                        <input id="city" type="text" name="city" placeholder="City*"
                                            value="{{ $user->city }}" required="required"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input id="territory" type="text" name="territory"
                                            placeholder="State*" value="{{ $user->territory }}"
                                            required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input id="pincode" type="number" name="pincode"
                                            placeholder="Pincode*" value="{{ $user->pincode }}"
                                            required="required" min="0" minlength="6" maxlength="6"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Street Address <span class="text-danger">*</span></label>
                                        <textarea id="address" name="address" placeholder="Address*"
                                            required="required"
                                            class="form-control">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="save_button primary_btn default_button">
                                            <button type="submit" class="button_update">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection @section('extracss')
<style>
label{
    padding: 10px 0px;
}
.form-control {
    font-size: 14px;
    padding-left: 15px;
    height: 16px;
}
textarea{
    padding:10px 15px !important;
    height: 80px !important;
}
</style>
@endsection
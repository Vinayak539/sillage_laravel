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
                            <form class="form" method="POST" action="{{ route('user.profile.updateRequest') }}"
                                id="formUpdateProfile">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Email ID <span class="text-d">*</span></label>
                                        <input class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input id="name" type="text" name="name" placeholder="Name*"
                                            value="{{ $user->name }}" required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Mobile Number <span class="text-danger">*</span></label>
                                        <input id="mobile" type="text" name="mobile" placeholder="Mobile Number*"
                                            value="{{ $user->mobile }}" required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Town/City <span class="text-danger">*</span></label>
                                        <input id="city" type="text" name="city" placeholder="City*"
                                            value="{{ $user->city }}" required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input id="territory" type="text" name="territory" placeholder="State*"
                                            value="{{ $user->territory }}" required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input id="pincode" type="number" name="pincode" placeholder="Pincode*"
                                            value="{{ $user->pincode }}" required="required" min="0" minlength="6"
                                            maxlength="6" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Street Address <span class="text-danger">*</span></label>
                                        <textarea id="address" name="address" placeholder="Address*" required="required"
                                            class="form-control">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="save_button primary_btn default_button">
                                            <button type="submit" class="submit_button"> <i class="fa fa-send"
                                                    aria-hidden="true"></i> Update</button>
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
    label {
        padding: 10px 0px;
    }

    .form-control {
        font-size: 14px;
        padding-left: 15px;
        height: 16px;
    }

    textarea {
        padding: 10px 15px !important;
        height: 80px !important;
    }

    .error {
        color: #fc544b !important;
    }
</style>
@endsection

@section('extrajs')
<script>
    $("#formUpdateProfile").validate({
            rules: {

                name: {
                    required: true
                },

                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },

                country: {
                    required: true,
                },

                address: {
                    required: true,
                },

                city: {
                    required: true,
                },

                territory: {
                    required: true,
                },

                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
            },
            messages: {

                name: {
                    required: "Please Enter Name"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    maxlength: "Mobile Number should be of 10 digits",
                    minlength: "Mobile Number should be of 10 digits"
                },

                country: {
                    required: "Please Select Country"
                },

                address: {
                    required: "Please Enter Address"
                },

                city: {
                    required: "Please Enter City"
                },

                territory: {
                    required: "Please Enter Territory"
                },

                pincode: {
                    required: "Please Enter Pincode",
                    minlength: "Pincode should be of 6 digits",
                    maxlength: "Pincode should be of 6 digits",
                },

            },
            submitHandler: function (form) {
                $('.submit_button').attr('disabled', 'disabled');
                $(".submit_button").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

</script>
@endsection

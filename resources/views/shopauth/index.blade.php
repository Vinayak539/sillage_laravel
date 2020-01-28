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
                    <li class="current"><a href="{{ route('shop.dashboard') }}">Orders</a></li>
                    <li><a href="{{ route('shop.account') }}">Account</a></li>
                    <li><a href="{{ route('shop.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                   <form id="logout-form" action="{{ route('shop.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                            <form class="form" method="POST" action="{{ route('shop.update') }}" id="formUpdateProfile">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Shop Code </label>
                                            <input class="form-control" value="{{ $shop->shop_code }}" disabled
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input class="form-control" value="{{ $shop->email }}" disabled readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $shop->name }}" placeholder="Enter Shop Name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">City <span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="city" class="form-control"
                                                value="{{ $shop->city }}" placeholder="Enter City" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ $shop->address }}" placeholder="Enter Shop Address" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="number" name="mobile" id="mobile" class="form-control"
                                                value="{{ $shop->mobile }}" placeholder="Enter Mobile Number"
                                                minlength="8" min="0000000000" maxlength="6" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Change Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                value="{{ old('password') }}" placeholder="Enter New Password">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="con_password">Confirm Password</label>
                                            <input type="password" name="con_password" id="con_password"
                                                class="form-control" value="{{ old('con_password') }}"
                                                placeholder="Re-Enter Password">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btnSubmit"> <i
                                                class="fa fa-edit"></i>
                                            Update</button>
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

            address: {
                required: true,
            },

            city: {
                required: true,
            },

            con_password:{
                equalTo:"#password"
            }
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

            address: {
                required: "Please Enter Address"
            },

            city: {
                required: "Please Enter City"
            },

            con_password:{
                equalTo: "Please Enter Confirm Password same as password"
            }

        },
        submitHandler: function (form) {
            $('.btnSubmit').attr('disabled', 'disabled');
            $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            form.submit();
        }
    });

</script>
@endsection

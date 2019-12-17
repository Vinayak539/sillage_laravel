@extends('layouts.master') @section('title','My Account') @section('content')

<!-- Breadcrumb area Start -->
<div
    class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40"
>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">My Account</h1>
                <ul class="breadcrumb justify-content-center">
                    <li>
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="current"><span>My Account</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<section class="main_content_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form
                    class="form"
                    method="POST"
                    action="{{ route('user.change-password.updateRequest') }}"
                >
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label
                                >Email ID <span class="text-d">*</span></label
                            >
                            <input
                                class="form-control"
                                value="{{ $user->email }}"
                                disabled
                            />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Change Password"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Confirm Password <span class="text-danger">*</span></label>
                            <input
                                id="con_password"
                                type="password"
                                name="con_password"
                                placeholder="Re-Enter Password"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-md btn-dark button_update">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
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
</style>
@endsection

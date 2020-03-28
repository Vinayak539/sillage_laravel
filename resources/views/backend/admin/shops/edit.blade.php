@extends('layouts.admin-master')
@section('title', 'Update Shop Details')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Shop</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.shops.all') }}"> All Shops</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Shop</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditShop" class="needs-validation">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shop Code </label>
                            <input class="form-control" value="{{ $shop->shop_code }}" disabled readonly>
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
                            <input type="text" name="name" id="name" class="form-control" value="{{ $shop->name }}"
                                placeholder="Enter Shop Name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ $shop->city }}"
                                placeholder="Enter City" required>
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
                                value="{{ $shop->mobile }}" placeholder="Enter Mobile Number" minlength="10"
                                min="0000000000" maxlength="10" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--Select--</option>
                                <option value="1" {{ $shop->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $shop->status == false ? 'selected': '' }}>Inactive</option>
                            </select>
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
                            <input type="password" name="con_password" id="con_password" class="form-control"
                                value="{{ old('con_password') }}" placeholder="Re-Enter Password">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_no">Account Number </label>
                            <input type="text" name="account_no" id="account_no" class="form-control"
                                value="{{ $shop->account_no }}" placeholder="Enter Account Number">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ifsc_code">IFSC Code </label>
                            <input type="text" name="ifsc_code" id="ifsc_code" class="form-control"
                                value="{{ $shop->ifsc_code }}" placeholder="Enter IFSC Code">
                        </div>
                    </div>


                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit"> <i class="fas fa-pencil-alt"></i>
                            Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</section>

@endsection

@section('extrajs')
<script>
    $("#formEditShop").validate({
        rules: {

            name: {
                required: true
            },

            city: {
                required: true
            },

            address: {
                required: true
            },

            mobile: {
                required: true
            },

            status: {
                required: true
            },

        },
        messages: {

            name: {
                required: "Please Enter Shop Name"
            },

            city: {
                required: "Please Enter City"
            },

            address: {
                required: "Please Enter Shop Address"
            },

            mobile: {
                required: "Please Enter Mobile"
            },

            status: {
                required: "Please Select Status"
            },

        },
        submitHandler: function (form) {
            $('.btnSubmit').attr('disabled', 'disabled');
            $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            form.submit();
        }
    });

</script>
@endsection

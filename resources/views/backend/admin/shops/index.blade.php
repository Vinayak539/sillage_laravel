@extends('layouts.admin-master')
@section('title', 'Manage Shops')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Shop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" role="form" class="needs-validation" id="formAddShop">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter Shop Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}"
                                    placeholder="Enter City" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}" placeholder="Enter Shop Address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control"
                                    value="{{ old('mobile') }}" placeholder="Enter Mobile Number" minlength="8"
                                    min="0000000000" maxlength="6" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" placeholder="Enter Email ID" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') }}" placeholder="Enter Password" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="con_password">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="con_password" id="con_password" class="form-control"
                                    value="{{ old('con_password') }}" placeholder="Enter Re-enter Password" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_no">Account Number </label>
                                <input type="text" name="account_no" id="account_no" class="form-control"
                                    value="{{ old('account_no') }}" placeholder="Enter Account Number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ifsc_code">IFSC Code </label>
                                <input type="text" name="ifsc_code" id="ifsc_code" class="form-control"
                                    value="{{ old('ifsc_code') }}" placeholder="Enter IFSC Code">
                            </div>
                        </div>

                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}
<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Shops</li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Shop</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Shops</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Mobile</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shops as $shop)
                        <tr>
                            <td>{{ $shop->shop_code }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->city }}</td>
                            <td>{{ $shop->mobile }}</td>
                            <td>{{ $shop->total ? $shop->total : '0' }}</td>
                            <td>
                                {{ $shop->status == true ? 'Active' : 'Blocked' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($shop->created_at)) }}</td>
                            <td>
                                <a href="{{ route('admin.shops.edit', $shop->id) }}" class="btn btn-outline-primary btn-sm"
                                    title="Edit Detail">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="8">
                                <h4>No Shops Found..</h4>
                            </td>
                        </tr>
                        @endforelse
                        @if($shops->total() > 50)
                        <tr class="text-center">
                            <td colspan="8">
                                {{ $shops->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Mobile</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection

@section('extrajs')
<script>
    $(document).ready(function () {

        $("#formAddShop").validate({
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
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },

                email: {
                    required: true,
                    email: true
                },

                password: {
                    required: true
                },

                con_password: {
                    required: true,
                    equalTo: "#password"
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
                    required: "Please Enter Mobile Number",
                    number: "Mobile Number should be Numeric Only",
                    minlength: "Mobile Number should be of 10 Digits Only",
                    maxlength: "Mobile Number should be of 10 Digits Only",
                },

                email: {
                    required: "Please Enter Email ID",
                    email: "Please Enter Valid Email ID"
                },

                password: {
                    required: "Please Enter Password"
                },

                con_password: {
                    required: "Please Enter Confirm Password",
                    equalTo: "Please Enter Confirm Password same as Above Password"
                },
            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });
    });

</script>
@endsection

@extends('layouts.master') @section('title','My Account') @section('content')

    <div class="modal fade" id="orderHelp">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Address</h4>
                    <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" role="form" class="needs-validation" id="formAddAddress"
                          action="{{ route('user.addresses.add') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <textarea name="address" id="address" rows="5" class="form-control"
                                                  placeholder="Enter Address here..."
                                                  required>{{ old('address') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="landmark">Landmark </label>
                                        <input type="text" name="landmark" id="landmark" class="form-control"
                                               value="{{ old('landmark') }}" placeholder="Enter Landmark">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="city">Town/City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control"
                                               value="{{ old('city') }}" placeholder="Enter City" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="territory">State <span class="text-danger">*</span></label>
                                        <input type="text" name="territory" id="territory" class="form-control"
                                               value="{{ old('territory') }}" placeholder="Enter State" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                        <input type="number" name="pincode" id="pincode" class="form-control"
                                               value="{{ old('pincode') }}" placeholder="Enter Pincode" min="0"
                                               minlength="6" maxlength="6" required>
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="type_of_address" class="form__label form__label--2">
                                            Type of Address <span class="required">*</span>
                                        </label>
                                        <label for="home">
                                            <input type="radio" name="type_of_address" id="home" value="0" checked>
                                            Home
                                        </label>
                                        <label for="corporate"><input type="radio" name="type_of_address" id="corporate"
                                                                      value="1">
                                            Office/Commercial
                                        </label>
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
    </div>


    !-- Breadcrumb area Start -->
    <div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40"
    >
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">My Account</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li>
                            <a href="{{ route('user.dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="" data-toggle="modal" data-target="#orderHelp">Add Address</a>
                        </li>
                        <li class="current"><span>Manage Addresses</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="main_content_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">

                        @forelse($user->addresses as $add)
                            <li class="list-group-item">
                                <div class="dropdown pull-right">
                                    <a class="dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu bg-white p-3">
                                        <li>
                                            <a href="{{ route('user.addresses.edit', $add->id) }}"> <i
                                                    class="fa fa-edit"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="obj-delete"
                                               data-obj-id="{{ $add->id }}"> <i class="fa fa-trash"> Delete</i></a>
                                        </li>
                                    </ul>
                                </div>
                                <h5>
                                    <span class="badge badge-secondary">{{ $add->type_of_address ? 'Office/Commercial' : 'Home' }}</span>
                                </h5>
                                <strong>{{ $add->name }}</strong><br>

                                <address>
                                    {{ $add->address  }}, {{ $add->landmark }}, {{ $add->city }}, {{ $add->territory }}
                                                        -
                                    <strong>{{ $add->pincode }}</strong>
                                </address>
                            </li>

                        @empty

                            <li class="text-danger text-center">
                                <h3>
                                    No Address Found... <a href="" data-toggle="modal" data-target="#orderHelp">Add
                                                                                                                Address</a>
                                </h3>
                            </li>

                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <form action="{{ route('user.addresses.delete') }}" method="post" id="formDelete">
        @csrf
        <input type="hidden" name="address_id" id="txtAddID">
    </form>
@endsection
@section('extrajs')

    <script>
        $(document).ready(function () {

            $("#formAddAddress").validate({
                rules: {

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

                    type_of_address: {
                        required: true
                    }
                },
                messages: {

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

                    type_of_address: {
                        required: "Please Select Address Type"
                    },

                    pincode: {
                        required: "Please Enter Pincode",
                        minlength: "Pincode should be of 6 digits",
                        maxlength: "Pincode should be of 6 digits",
                    },

                },
                submitHandler: function (form) {
                    $('.btnSubmit').attr('disabled', 'disabled');
                    $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                    form.submit();
                }
            });

            $('.obj-delete').click(function () {

                if (window.confirm('Are you sure want to delete ? ')) {
                    $('#txtAddID').val($(this).attr('data-obj-id'));
                    $('#formDelete').submit();
                }
            });
        });
    </script>

@endsection

@extends('layouts.master') @section('title','Manage Addresses') @section('content')

!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Manage Addresses</h1>
                <ul class="breadcrumb justify-content-center">
                    <li>
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
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
            @foreach($user->addresses as $add)
            <div class="col-md-4">
                <label class="radio-cont">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title ">

                                {{ $add->name }}

                                <b><span class="badge badge-pill badge-primary"
                                        style="font-size: 12px;float:right;margin-top:6px">{{ $add->type_of_address ? 'Work' : 'Home' }}</span></b>
                            </h4>
                            <p class="card-text">
                                {{ $add->address }},
                                {{ $add->landmark }},
                                {{ $add->city }},
                                {{ $add->territory }},
                                {{ $add->country }},
                                {{ $add->pincode }},
                            </p>
                            @if($add->mobile)
                            <p class="text-info">
                                {{ $add->mobile }}
                            </p>
                            @else
                            <p class="text-danger">
                                Update Mobile Number
                            </p>
                            @endif

                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" class="card-link float-left remove-address"
                                data-obj-id="{{ $add->id }}"> <i class="fa fa-trash text-danger "></i> Remove</a>
                            <a href="javascript:void(0)" data-obj-id="{{ $add->id }}"
                                class="card-link float-right editAddress"> <i class="fa fa-pencil text-primary"></i> Edit</a>
                        </div>
                    </div>
                </label>
            </div>
            @endforeach

            <div class="col-md-4 add_address">
                <label class="radio-cont" data-toggle="modal" data-target="#new-address">
                    <div class="card">
                        <div class="card-body text-center pt--130" style="height: 334px;">
                            <i class="fa fa-plus-circle text-black"></i>
                            <p class="text-black"> Add new address</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
</section>

{{-- add new addresss start --}}
<div class="modal fade" id="new-address">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">ADD NEW ADDRESS</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('user.addresses.add') }}" method="post" id="formAddAddress">
                @csrf
                <div class="modal-body" style="height: 400px; overflow: auto">
                    <div class="form">

                        <div class="form-row mb--30">
                            <div class="form__group col-md-12 mb-sm--30">
                                <label for="name" class="form__label form__label--2">Name
                                    <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form__input form__input--2" required
                                    placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="mobile" class="form__label form__label--2">Mobile <span
                                        class="required">*</span></label>
                                <input type="text" name="mobile" id="mobile" class="form__input form__input--2"
                                    placeholder="Mobile Number" value="{{ old('mobile') }}" required>
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="email" class="form__label form__label--2">Email Address
                                    <span class="required">*</span></label>
                                <input type="email" name="email" id="email" class="form__input form__input--2" value=""
                                    placeholder="Email Address" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="country" class="form__label form__label--2">Country
                                    <span class="required">*</span></label>
                                <select id="country" name="country" class="form__input form__input--2 nice-select"
                                    required>
                                    <option value="">Select a country…</option>
                                    <option value="India" selected>India</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="txtPincode" name="pincode">
                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="address" class="form__label form__label--2">Street Address <span
                                        class="required">*</span></label>

                                <input type="text" name="address" id="address" class="form__input form__input--2 mb--30"
                                    placeholder="House number and street name" required value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="landmark" class="form__label form__label--2">Landmark</label>
                                <input type="text" name="landmark" id="landmark" class="form__input form__input--2"
                                    placeholder="Landmark" value="{{ old('landmark') }}">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="city" class="form__label form__label--2">Town / City
                                    <span class="required">*</span></label>
                                <input type="text" name="city" id="city" class="form__input form__input--2" required
                                    placeholder="Town/City" value="{{ old('city') }}">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="territory" class="form__label form__label--2">State
                                    <span class="required">*</span></label>
                                <input type="text" name="territory" id="territory" class="form__input form__input--2"
                                    required placeholder="State" value="{{ old('territory') }}">
                            </div>
                        </div>


                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="pincode" class="form__label form__label--2">Pincode
                                    <span class="required">*</span></label>
                                <input type="number" name="pincode" id="pincode" class="form__input form__input--2"
                                    required placeholder="Pincode" value="{{ old('pincode') }}">
                            </div>
                        </div>


                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="type_of_address" class="form__label form__label--2">Type of Address
                                    <span class="required">*</span></label>
                                <label for="home"><input type="radio" name="type_of_address" id="home" class=""
                                        value="0" {{ old('type_of_address') == true ? 'checked' : '' }} checked> Home</label>
                                <label for="corporate"><input type="radio" name="type_of_address" id="corporate"
                                        class="" value="1" {{ old('type_of_address') == false ? 'checked' : '' }}>
                                    Office/Commercial</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-secondary btnSubmit">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new addresss end --}}

{{-- edit addresss start --}}
<div class="modal fade" id="edit-address">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">EDIT ADDRESS</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('user.addresses.fupdate') }}" method="post" id="formUpdateAddress">
                @csrf
                <div class="modal-body" style="height: 400px; overflow: auto">
                    <div class="form" id="formEdit">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-secondary btnSubmit">UPDATE</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
{{-- edit addresss end --}}


<form action="{{ route('user.addresses.delete') }}" method="post" id="formAddDelete">
    @csrf

    <input type="hidden" name="address_id" id="txtAddID">
</form>

@endsection
@section('extrajs')

<script>
    $(document).ready(function () {

        $('.editAddress').click(function () {

            var address_id = $(this).attr('data-obj-id');

            $(this).html('<span class="fa fa-spinner fa-spin"></span> ');
            $(this).attr('disabled', 'disabled');

            if (address_id.length > 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $.ajax({
                    url: "{{ route('user.addresses.fedit') }}",
                    type: 'POST',
                    data: {
                        address_id: address_id,
                    },
                    success: function (result) {
                        if (result.data) {

                            var data = result.data;

                            var html =
                                `<div class="form-row mb--30">
                        <div class="form__group col-md-12 mb-sm--30">
                            <label for="name" class="form__label form__label--2">Name
                                <span class="required">*</span></label>
                            <input type="text" name="name" id="name" class="form__input form__input--2" required
                                placeholder="Name" value="${data.name}">
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-md-12 mb-sm--30">
                            <label for="mobile" class="form__label form__label--2">Mobile
                                <span class="required">*</span></label>
                            <input type="number" name="mobile" id="mobile" class="form__input form__input--2" required
                                placeholder="Mobile" value="${data.mobile}">
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-12">
                            <label for="address" class="form__label form__label--2">Street
                                Address <span class="required">*</span></label>

                            <input type="text" name="address" id="address" class="form__input form__input--2 mb--30"
                                placeholder="House number and street name" required value="${data.address}" required>
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-12">
                            <label for="landmark" class="form__label form__label--2">Landmark</label>
                            <input type="text" name="landmark" id="landmark" class="form__input form__input--2"
                                placeholder="Landmark" value="${data.landmark ? data.landmark : '' }">
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-12">
                            <label for="city" class="form__label form__label--2">Town / City
                                <span class="required">*</span></label>
                            <input type="text" name="city" id="city" class="form__input form__input--2" required
                                placeholder="Town/City" value="${data.city}" required>
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-12">
                            <label for="territory" class="form__label form__label--2">State
                                <span class="required">*</span></label>
                            <input type="text" name="territory" id="territory" class="form__input form__input--2"
                                required placeholder="State" value="${data.territory}" required>
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-12">
                            <label for="pincode" class="form__label form__label--2">Pincode
                                <span class="required">*</span></label>
                            <input type="text" name="pincode" id="pincode" class="form__input form__input--2"
                                required placeholder="Pincode" value="${data.pincode}" required>
                        </div>
                    </div>

                    <div class="form-row mb--30">
                        <div class="form__group col-12">
                            <label class="form__label form__label--2">Type of Address
                                <span class="required">*</span></label>
                            <label for="home"><input type="radio" name="type_of_address" id="home"
                                    value="0" ${ data.type_of_address == '0' ? 'checked' : '' }> Home</label>
                            <label for="corporate"><input type="radio" name="type_of_address" id="corporate"
                                     value="1" ${ data.type_of_address == '1' ? 'checked' : '' }>
                                Office/Commercial</label>
                        </div>
                    </div>
                    <input type="hidden" name="address_id" value="${data.id}">`

                            $('#formEdit').html(html);
                            $('#edit-address').modal('show');
                            $('.editAddress').html(
                                '<a href="javascript:void(0)" data-obj-id=' +
                                address_id +
                                'class="card-link float-right editAddress">Edit</a>');
                            $('.editAddress').removeAttr('disabled');

                        }
                    }
                });
            }


        });
        
        $("#formAddAddress").validate({
            rules: {

                name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },

                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                
                pincode: {
                    required: true,
                    number: true,
                    minlength: 6,
                    maxlength: 6
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

                type_of_address: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "Please Enter Name"
                },

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Please Enter Proper Mobile Number",
                    minlength: "Mobile Number should be of 10 digits",
                    maxlength: "Mobile Number should be of 10 digits",
                },

                pincode: {
                    required: "Please Enter Pincode",
                    number: "Please Enter Proper Pincode",
                    minlength: "Pincode should be of 6 digits",
                    maxlength: "Pincode should be of 6 digits",
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

                type_of_address: {
                    required: "Please Select Address Type"
                },

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#formUpdateAddress").validate({
            rules: {

                name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },

                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
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

                type_of_address: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "Please Enter Name"
                },

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Please Enter Proper Mobile Number",
                    minlength: "Mobile Number should be of 10 digits",
                    maxlength: "Mobile Number should be of 10 digits",
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

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $('.remove-address').click(function () {

            if (window.confirm('Are you sure want to delete this address ? ')) {

                var address_id = $(this).attr('data-obj-id');
                $('#txtAddID').val(address_id);
                $('.remove-address').html('<span class="fa fa-spinner fa-spin"></span> ');
                $('.remove-address').attr('disabled', 'disabled');
                $('#formAddDelete').submit();
            }

        });

    });

</script>

@endsection

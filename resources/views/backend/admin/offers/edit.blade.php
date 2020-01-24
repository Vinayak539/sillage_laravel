@extends('layouts.admin-master')
@section('title', 'Update Offer Details')
@section('content')


<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.offers.map.offer') }}" id="formAddOffer"
                class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Categories <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <option value=""> --Select Category--</option>
                                    @foreach($categories as $cate)
                                    <option value="{{ $cate->id }}"
                                        {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                                        {{ $cate->pcategory ? $cate->pcategory->name . ' > ' . $cate->name : $cate->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label id="" class="error" for="category_id"></label>
                            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="offer_product_id">Offer Products <span class="text-danger">*</span></label>
                                <select name="offer_product_id" class="form-control products" id="offer_product_id"
                                    required>
                                    <option value=""> --Select Category First--</option>

                                </select>
                            </div>
                            <label id="" class="error" for="offer_product_id"></label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="offer_color_id">Offer Colours <span class="text-danger">*</span></label>
                                <select name="offer_color_id" class="form-control offer_colors" id="offer_color_id"
                                    required>
                                    <option value=""> --Select Offer Product First --</option>

                                </select>
                            </div>
                            <label id="" class="error" for="offer_color_id"></label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="offer_size_id">Offer Sizes <span class="text-danger">*</span></label>
                                <select name="offer_size_id" class="form-control offer_sizes" id="offer_size_id"
                                    required>
                                    <option value=""> --Select Offer Product First --</option>
                                </select>
                            </div>
                            <label id="" class="error" for="offer_size_id"></label>
                        </div>
                    </div>

                    <div class="col-md-12 text-danger">
                        Note : All * Mark Fields are Compulsory !
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

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Offer</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.offers.all') }}"> All Offers</a></li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Offer</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Offer</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditOffer" class="needs-validation">
                @csrf
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $offer->title }}" name="title" type="text" id="title"
                                placeholder="Title">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span> </label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--Select--</option>
                                <option value="1" {{ $offer->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $offer->status == false ? 'selected': '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fa fa-edit"></i> Update
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>All Offer Products of {{ $offer->title }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Colours</th>
                            <th>Sizes</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($map_offers as $ofr)
                        <tr>
                            <td>{{ $ofr->map_id }}</td>
                            <td>{{ $ofr->category_name }}</td>
                            <td>{{ $ofr->product_name }}</td>
                            <td>{{ $ofr->color_name }}</td>
                            <td>{{ $ofr->size_name }}</td>
                            <td>
                                {{ $ofr->status == true ? 'Active' : 'Blocked' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($ofr->created_at)) }}</td>
                            <td>
                                <a href="javascript:void(0)" data-role="delete-obj" data-obj-id="{{ $ofr->map_id }}"
                                    class="btn btn-outline-danger btn-sm delete-object" title="Delete Offer">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="8">
                                <h4>No Offers Found..</h4>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Colours</th>
                            <th>Sizes</th>
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

<form id="formDelete" method="POST" action="{{ route('admin.offers.delete') }}">
    @csrf
    <input type="hidden" name="offer_id" id="txtOfferID">
</form>

@endsection

@section('extrajs')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>
<script>
    $(document).ready(function () {

        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                $("#txtOfferID").val($(this).attr("data-obj-id"));
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span>');
                $("#formDelete").submit();
            }
        });

        $("#formEditOffer").submit(function () {

            $('.btnSubmit').attr('disabled', 'disabled');
            $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            $("#formEditOffer").submit();

        });

        $("#formAddOffer").validate({
            rules: {

                category_id: {
                    required: true
                },

                product_id: {
                    required: true
                },

                offer_product_id: {
                    required: true
                },

                offer_color_id: {
                    required: true
                },

                offer_size_id: {
                    required: true
                },

                purchase_qty: {
                    required: true
                },

                offered_qty: {
                    required: true
                },

            },
            messages: {

                category_id: {
                    required: "Please Select Category"
                },

                product_id: {
                    required: "Please Select Product"
                },

                offer_product_id: {
                    required: "Please Select Offer Product"
                },

                offer_color_id: {
                    required: "Please Select Offer Colour"
                },

                offer_size_id: {
                    required: "Please Select Offer Size"
                },

                purchase_qty: {
                    required: "Please Enter Purchase Quantity"
                },

                offered_qty: {
                    required: "Please Enter Offered Quantity"
                },

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $('#category_id').change(function () {

            var cateID = $(this).val();

            if (cateID.length > 0) {

                $(".modal-body").LoadingOverlay("show");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ route('admin.offers.getProduct') }}",
                    type: 'POST',
                    data: {
                        cate_id: cateID,
                    },

                    success: function (result) {

                        var products = result.products;

                        var html = '';


                        if (products.length > 0) {

                            html += '<option value="">--Select Product--</option>';

                            products.forEach(data => {

                                html +=
                                    `<option value="${data.id}">${data.title}</option>`
                            });

                        } else {
                            html += '<option value="">No Product Found</option>';

                        }

                        $('.products').html(html);

                        $(".modal-body").LoadingOverlay("hide", true);

                    }
                });
            } else {
                $('.products').html('<option value="">--Select Category First--</option>')
            }

        });

        $('#offer_product_id').change(function () {
            var prodID = $(this).val();

            if (prodID.length > 0) {

                $(".modal-body").LoadingOverlay("show");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ route('admin.offers.getColors') }}",
                    type: 'POST',
                    data: {
                        prod_id: prodID,
                    },

                    success: function (result) {

                        var colors = result.colors;
                        var sizes = result.sizes;

                        var html = '';
                        var sizehtml = '';

                        if (colors.length > 0) {

                            html += '<option value="">--Select Colour--</option>';

                            colors.forEach(data => {

                                html +=
                                    `<option value="${data.color_id}">${data.color.title}</option>`
                            });

                            $('.offer_colors').html(html);

                        } else {

                            html += '<option value="">No Colours Found</option>';

                            $('.offer_colors').html(html);
                        }

                        if (sizes.length > 0) {

                            sizehtml += '<option value="">--Select Size--</option>';

                            sizes.forEach(data => {

                                sizehtml +=
                                    `<option value="${data.size_id}">${data.size.title}</option>`
                            });

                            $('.offer_sizes').html(sizehtml);

                        } else {

                            sizehtml += '<option value="">No Sizes Found</option>';

                            $('.offer_sizes').html(sizehtml);
                        }

                        $(".modal-body").LoadingOverlay("hide", true);
                    }
                });
            } else {
                $('.offer_colors').html('<option value="">--Select Product First--</option>');
                $('.offer_sizes').html('<option value="">--Select Product First--</option>');
            }
        });
    });

</script>
@endsection

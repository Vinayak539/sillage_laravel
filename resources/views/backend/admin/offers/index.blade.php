@extends('layouts.admin-master')
@section('title', 'Manage Offers')
@section('content')


{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Offer Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formAddOffer" class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input class="form-control" value="{{ old('title') }}" name="title" type="text"
                                    id="title" placeholder="Title" required>
                            </div>
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

{{-- Model End --}}

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Offers</li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Offer Title</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Offers</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($offers as $offer)
                        <tr>
                            <td>{{ $offer->id }}</td>
                            <td>{{ $offer->title }}</td>
                            <td>
                                {{ $offer->status == true ? 'Active' : 'Blocked' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($offer->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.offers.edit', $offer->id) }}" class="dropdown-item"
                                            title="Edit Detail">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </div>
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
                            <th>Title</th>
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
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>
<script>
    $(document).ready(function () {
        
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

                $(".modal-content").LoadingOverlay("show");

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

                        $(".modal-content").LoadingOverlay("hide", true);

                    }
                });
            }

        });

        $('#product_id').change(function () {
            var prodID = $(this).val();

            if (prodID.length > 0) {

                $(".modal-content").LoadingOverlay("show");

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
                                    `<option value="${data.id}">${data.color.title}</option>`
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
                                    `<option value="${data.id}">${data.size.title}</option>`
                            });

                            $('.offer_sizes').html(sizehtml);

                        } else {

                            sizehtml += '<option value="">No Sizes Found</option>';

                            $('.offer_sizes').html(sizehtml);
                        }

                        $(".modal-content").LoadingOverlay("hide", true);
                    }
                });
            }

        });
    });

</script>
@endsection
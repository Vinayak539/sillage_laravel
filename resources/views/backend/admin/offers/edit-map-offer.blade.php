@extends('layouts.admin-master')
@section('title', 'Update Offer Details')
@section('content')

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
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Offer Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Category</label>
                    <h5>{{ $offer->category->name }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Product</label>
                    <h5>{{ $offer->product->title }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Offer Product</label>
                    <h5>{{ $offer->offerproduct->title }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Offer Colour</label>
                    <h5>{{ $offer->color->title }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Offer Size</label>
                    <h5>{{ $offer->size->title }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Purchase Quantity</label>
                    <h5>{{ $offer->product->purchase_qty }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Offered Quantity</label>
                    <h5>{{ $offer->product->offered_qty }}</h5>
                </div>
                <div class="col-md-4 form-group">
                    <label>Offer Status</label>
                    <h5>{{ $offer->status == true ? 'Active' : 'Inactive' }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Offer</h4>
        </div>
        <div class="card-body card1">
            <form method="post" id="formEditOffer" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Change Categories <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value=""> --Select Category--</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label id="" class="error" for="category_id"></label>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_id">Change Products <span class="text-danger">*</span></label>
                            <select name="product_id" class="form-control products" id="product_id">
                                <option value=""> --Select Category First--</option>

                            </select>
                        </div>
                        <label id="" class="error" for="product_id"></label>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="offer_product_id">Change Offer Products <span
                                    class="text-danger">*</span></label>
                            <select name="offer_product_id" class="form-control" id="offer_product_id">
                                <option value=""> --Select Offer Product--</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('offer_product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <label id="" class="error" for="offer_product_id"></label>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="offer_color_id">Change Offer Colours <span class="text-danger">*</span></label>
                            <select name="offer_color_id" class="form-control offer_colors" id="offer_color_id">
                                <option value=""> --Select Offer Product First --</option>

                            </select>
                        </div>
                        <label id="" class="error" for="offer_color_id"></label>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="offer_size_id">Change Offer Sizes <span class="text-danger">*</span></label>
                            <select name="offer_size_id" class="form-control offer_sizes" id="offer_size_id">
                                <option value=""> --Select Offer Product First --</option>
                            </select>
                        </div>
                        <label id="" class="error" for="offer_size_id"></label>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="purchase_qty">Change Purchase Quantity <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" value="{{ old('purchase_qty') }}" name="purchase_qty"
                                type="text" id="purchase_qty" placeholder="Purchase Quantity">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="offered_qty">Change Offered Quantity <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ old('offered_qty') }}" name="offered_qty" type="text"
                                id="offered_qty" placeholder="Offered Quantity">
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

</section>

@endsection

@section('extrajs')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>
<script>
    $(document).ready(function () {

        $("#formEditOffer").submit(function () {

            $('.btnSubmit').attr('disabled', 'disabled');
            $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            $("#formEditOffer").submit();

        });

        $('#category_id').change(function () {

            var cateID = $(this).val();

            if (cateID.length > 0) {

                $(".card1").LoadingOverlay("show");

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

                        $(".card1").LoadingOverlay("hide", true);

                    }
                });
            } else {
                $('.products').html('<option value="">--Select Category First--</option>')
            }

        });

        $('#product_id').change(function () {
            var prodID = $(this).val();

            if (prodID.length > 0) {

                $(".card1").LoadingOverlay("show");

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

                        $(".card1").LoadingOverlay("hide", true);
                    }
                });
            }

        });
    });

</script>
@endsection

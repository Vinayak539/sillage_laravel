@extends('layouts.admin-master')
@section('title', 'Edit Product')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Edit Product</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.products.all') }}">All Products</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal"> Add More Custom Fields</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addImageModal" data-toggle="modal" data-target="#addImageModal"> Add More Images</a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Add More Size of {{ $product->title }}</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <form action="/adrana951/manage-products/add-product-custom-field/{{$product->id}}" method="POST"
                class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="field_name"> Field Name</label>
                        <input type="text" required="required" name="field_name" value="{{ old('field_name') }}"
                            class="form-control" id="field_name" placeholder="Enter Field Name">
                    </div>
                    <div class="form-group">
                        <label for="field_value">Field Value </label>
                        <input type="text" name="field_value" value="{{ old('field_value') }}" class="form-control"
                            id="field_value" min="1" placeholder="Enter Field Value" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Add Custom Field
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

{{-- Image Model --}}

<div class="modal" id="addImageModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Add More Image of {{ $product->title }}</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <form action="/adrana951/manage-products/add-product-images/{{$product->id}}" method="POST"
                class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image_urls"> Images <span class="text-danger">*</span></label>
                        <input type="file" required="required" name="image_urls[]" class="form-control" id="image_urls"
                            accept="image/jpeg, image/png" multiple>
                    </div>

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Add Images
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

<div class="card">
    <div class="card-block">
        <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <h5> <i class="fa fa-warning"></i> Note : Product Image should be of width: 600px & height:
                                600px.</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">--Select Category--</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Name <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $product->title }}" placeholder="Enter Product Name" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="brand_id">Brand <span class="text-danger">*</span></label>
                            <select name="brand_id" id="brand_id" class="form-control" required>
                                <option value="">--Select Brand--</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="color_id">Color </label>
                            <select name="color_id" id="color_id" class="form-control">
                                <option value="">--Select Colour--</option>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ $color->id == $product->color_id ? 'selected' : '' }}>{{ $color->color }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="material_id">Material </label>
                            <select name="material_id" id="material_id" class="form-control">
                                <option value="">--Select Material--</option>
                                @foreach($materials as $material)
                                <option value="{{ $material->id }}"
                                    {{ $material->id == $product->material_id ? 'selected' : '' }}>
                                    {{ $material->material_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="weight_id">Unit </label>
                            <select name="weight_id" id="weight_id" class="form-control">
                                <option value="">--Select Unit--</option>
                                @foreach($units as $unit)
                                <option value="{{ $unit->id }}"
                                    {{ $unit->id == $product->weight_unit ? 'selected' : '' }}>{{ $unit->unit }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="condition_id">Condition <span class="text-danger">*</span></label>
                            <select name="condition_id" id="condition_id" class="form-control" required>
                                <option value="">--Select Condition--</option>
                                @foreach($conditions as $condition)
                                <option value="{{ $condition->id }}"
                                    {{ $condition->id == $product->condition_id ? 'selected' : '' }}>
                                    {{ $condition->condition }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="warranty_id">Warranty <span class="text-danger">*</span></label>
                            <select name="warranty_id" id="warranty_id" class="form-control" required>
                                <option value="">--Select Warranty--</option>
                                @foreach($warranties as $warranty)
                                <option value="{{ $warranty->id }}"
                                    {{ $warranty->id == $product->warranty_id ? 'selected' : '' }}>
                                    {{ $warranty->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image_url">Change Image </label>
                            <input type="file" name="image_url" id="image_url" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upc">UPC </label>
                            <input type="text" name="upc" id="upc" class="form-control" value="{{ $product->upc }}"
                                placeholder="Enter UPC">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                value="{{ $product->expiry_date }}" placeholder="Select Expiry Date">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_id">GST <span class="text-danger">*</span></label>
                            <select name="gst_id" id="gst_id" class="form-control" required>
                                <option value="">--Select GST--</option>
                                @foreach($gsts as $gst)
                                <option value="{{ $gst->id }}" data-value="{{ $gst->gst_value }}"
                                    {{ $product->gst == $gst->id ? 'selected' : '' }}>
                                    {{ $gst->gst_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="buy_it_now_price">Selling Price <span class="text-danger">*</span></label>
                            <input type="number" name="buy_it_now_price" id="buy_it_now_price" class="form-control"
                                value="{{ $product->buy_it_now_price }}" placeholder="Enter Selling Price" min="1"
                                required>
                            <input type="hidden" name="gst_amount" id="gst_amount">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="starting_price">Price Before GST <span class="text-danger">*</span></label>
                            <input type="number" name="starting_price" id="starting_price" class="form-control"
                                value="{{ $product->starting_price }}" placeholder="Enter Price Before GST" min="1"
                                required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reserve_price">Bid Price <span class="text-danger">*</span></label>
                            <input type="number" name="reserve_price" id="reserve_price" class="form-control"
                                value="{{ $product->reserve_price }}" placeholder="Enter Bid Price " min="1" required>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mrp">MRP <span class="text-danger">*</span></label>
                            <input type="number" name="mrp" id="mrp" class="form-control" value="{{ $product->mrp }}"
                                placeholder="Enter Selling Price" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="length">length </label>
                            <input type="text" name="length" id="length" class="form-control"
                                value="{{ $product->length }}" placeholder="Enter length">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="breadth">breadth </label>
                            <input type="text" name="breadth" id="breadth" class="form-control"
                                value="{{ $product->breadth }}" placeholder="Enter breadth">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="height">height </label>
                            <input type="text" name="height" id="height" class="form-control"
                                value="{{ $product->height }}" placeholder="Enter height">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="width">Width </label>
                            <input type="text" name="width" id="width" class="form-control"
                                value="{{  $product->width }}" placeholder="Enter width">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="weight">weight </label>
                            <input type="text" name="weight" id="weight" class="form-control"
                                value="{{ $product->weight }}" placeholder="Enter weight">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                value="{{ $product->stock }}" placeholder="Enter Stock" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select Status--</option>
                                <option value="1" {{ $product->status == true ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $product->status == false ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="side_product">Featured Product</label>
                            <select name="side_product" id="side_product" class="form-control">
                                <option value="">--Select Featured Product Position--</option>
                                <option value="1"
                                    {{ $product->side_product ? $product->side_product->sort_index == 1 ? 'selected' : '' : '' }}>
                                    1</option>
                                <option value="2"
                                    {{ $product->side_product ? $product->side_product->sort_index == 2 ? 'selected' : '' : '' }}>
                                    2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="is_cod">Cod Available <span class="text-danger">*</span></label>
                            <select name="is_cod" id="is_cod" class="form-control" required>
                                <option value="">--Select Cod Availability--</option>
                                <option value="1" {{ $product->isCodAvailable == true ? 'selected' : '' }}>Available
                                </option>
                                <option value="0" {{ $product->isCodAvailable == false ? 'selected' : '' }}>Not
                                    Available</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label>Return Policy <span class="text-danger">*</span></label> <br>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="within_days" name="within_days"
                                    {{ $product->within_days == true ? 'checked' : '' }} value="1">
                                <label class="custom-control-label" for="within_days">Within 7 Days</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="wrong_products" value="1"
                                    name="wrong_products" {{ $product->wrong_products == true ? 'checked' : '' }}>
                                <label class="custom-control-label" for="wrong_products">Wrong Products</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="faulty_products" value="1"
                                    name="faulty_products" {{ $product->faulty_products == true ? 'checked' : '' }}>
                                <label class="custom-control-label" for="faulty_products">Faulty Products</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="quality_issue" value="1"
                                    name="quality_issue" {{ $product->quality_issue == true ? 'checked' : '' }}>
                                <label class="custom-control-label" for="quality_issue">Quality Issue</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="section_id">Top Section</label>
                            <select name="section_id" id="section_id" class="form-control" multiple>
                                <option value="">--Select Top Section--</option>
                                @foreach($top_sections as $section)
                                <option value="{{ $section->id }}" class="customCheck">
                                    {{ $section->SectionName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" rows="8" class="form-control"
                                        required>{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="keywords">Keywords </span><span class="text-danger">*</span> <span
                                            class="text-warning">(Use Comma "," to seperate
                                            keywords)</label>
                                    <textarea name="keywords" id="keywords" rows="8"
                                        class="form-control">{{ $keywords }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Existing Main Image</label>
                                    <div>
                                        <img src="/storage/images/products/{{ $product->image_url }}"
                                            alt="{{ $product->title }}" width="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($product->images))
                    <div class="col-md-12">
                        <label>Other Images</label>
                        <div class="row">
                            @foreach($product->images as $image)
                            <div class="col-md-2">
                                <img src="/storage/images/multi-products/{{ $image->image_url }}"
                                    alt="{{ $product->title }}" height="100">
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-danger image-delete"
                                        data-delete-id="{{ $image->id }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="col-md-12 text-danger mt-5">
                        Note : All * Mark Fields are Compulsory !
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fas fa-pencil-alt"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Available Custom Fields for {{ str_limit($product->title, 20) }}</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.products.all') }}">Manage Products</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal"> Add More Custom Fields</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addImageModal" data-toggle="modal" data-target="#addImageModal"> Add More Images</a>
                </li>
            </ul>
        </div>
    </div>

    @if($product->custom_fields)
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>

                    <th>
                        <label for="field_id">ID </label>
                    </th>
                    <th>
                        <label for="field_name">Field Name </label>
                    </th>
                    <th>
                        <label for="field_value">Field Value</label>
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->custom_fields as $key => $cf)
                <tr>
                    <td>
                        <input type="number" name="field_id[{{$key}}]" value="{{ $cf->id }}" class="form-control"
                            id="field_id" disabled>
                    </td>
                    <td>
                        <input type="text" name="field_name[{{$key}}]" value="{{ $cf->field_name }}"
                            class="form-control" id="field_name">
                    </td>
                    <td>
                        <input type="text" name="field_value[{{$key}}]" value="{{ $cf->field_value }}"
                            class="form-control" id="field_value">
                    </td>

                    <td>

                        <a href="javascript:void(0)" title="Update Data"
                            class="btn btn-primary text-white update-object" data-object-index="{{$key}}">
                            <i class="fa fa-save"></i>
                        </a>

                        <a href="javascript:void(0)" data-obj-id="{{$cf->id}}" title="Delete"
                            class="btn btn-danger text-white delete-object">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<form id="formDelete" method="POST" action="/adrana951/manage-products/delete-product-custom-field/">
    @csrf
</form>

<form id="formImageDelete" method="POST" action="/adrana951/manage-products/delete-image/">
    @csrf
</form>

<form id="formUpdate" method="POST" action="/adrana951/manage-products/update-product-custom-field/">
    @csrf
    <input type="hidden" name="field_name" id="txtFieldNameUpdate" />
    <input type="hidden" name="field_value" id="txtFieldValueUpdate" />
</form>

@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure to delete this Custom Field ?")) {
                var action = $("#formDelete").attr("action") + $(this).attr("data-obj-id");
                $("#formDelete").attr("action", action);
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });

        $(".image-delete").click(function () {
            if (window.confirm("Are you sure to delete this Image ?")) {
                var action = $("#formImageDelete").attr("action") + $(this).attr("data-delete-id");
                $("#formImageDelete").attr("action", action);
                $("#formImageDelete").submit();
                $(this).html('wait...');
            }
        });
        $(".update-object").click(function () {
            var index = $(this).attr("data-object-index");
            var field_id = $("input[name='field_id[" + index + "]']").val();
            $("#txtFieldNameUpdate").val($("input[name='field_name[" + index + "]']").val());
            $("#txtFieldValueUpdate").val($("input[name='field_value[" + index + "]']").val());
            var action = $("#formUpdate").attr("action") + field_id;
            $("#formUpdate").attr("action", action);
            $("#formUpdate").submit();
            $(this).html('wait...');

        });

        $('#buy_it_now_price').on('keyup', function () {
            var gst = $('option:selected', '#gst_id').attr('data-value');
            var gst_value = 1 + (gst / 100);
            var buy_it_now_price = $(this).val();
            var before_gst_price = Math.round(buy_it_now_price / gst_value);
            var gst_amount = Math.round(buy_it_now_price - before_gst_price)
            $('#starting_price').val(before_gst_price);
            $('#gst_amount').val(gst_amount);
        });

        var old_categories = {!! json_encode($product -> topSection) !!};

        if (old_categories && typeof old_categories == "object") {
            for (x of old_categories) {
                $(".customCheck[value=" + x.section_id + "]").attr('selected', 'selected');
            }
        }

    });

</script>
@endsection
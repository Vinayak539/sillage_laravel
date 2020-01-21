@extends('layouts.admin-master')
@section('title', 'Edit Product')
@section('content')


{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add More Cuistom Field of {{ $product->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.products.add.custom.field', $product->id) }}" method="POST"
                class="needs-validation" id="formAddCustom">
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
                            id="field_value" placeholder="Enter Field Value" required>
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

{{-- <div class="modal" id="addImageModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add More Images of {{ $product->title }}</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ route('admin.products.add.images', $product->id) }}" method="POST" class="needs-validation"
    enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="image_urls"> Images <span class="text-danger">*</span></label>
            <input type="file" required="required" name="image_urls[]" class="form-control" id="image_urls"
                accept="image/jpeg, image/png" multiple>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnSubmit">
            <i class="fa fa-plus"></i> Add Images
        </button>
    </div>
</form>
</div>
</div>
</div> --}}

{{-- Model End --}}


{{-- Color & Size Model --}}

<div class="modal" id="addColorModal">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add More Color & Size of {{ $product->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.products.add.color', $product->id) }}" method="POST" class="needs-validation"
                enctype="multipart/form-data" id="formAddColor">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="color_id">Colour <span class="text-danger">*</span></label>
                        <select name="color_id" id="color_id" class="form-control" required>
                            <option value="">--Select Colour--</option>
                            @foreach($colors as $color)
                            <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                {{ $color->title }}
                            </option>
                            @endforeach
                        </select>
                        <label id="" class="error" for="color_id"></label>
                    </div>

                    <div class="form-group">
                        <label for="size_id">Sizes <span class="text-danger">*</span></label>
                        <select name="size_id" id="size_id" class="form-control" required>
                            <option value="">--Select Sizes--</option>
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                                {{ $size->title }}
                            </option>
                            @endforeach
                        </select>
                        <label id="" class="error" for="size_id"></label>
                    </div>

                    <div class="form-group">
                        <label for="mrp">Selling Price <span class="text-danger">*</span></label>
                        <input type="text" name="mrp" id="mrp" class="form-control" value="{{ old('mrp') }}"
                            placeholder="Enter Selling Price" required>
                    </div>

                    <div class="form-group">
                        <label for="starting_price">MRP <span class="text-danger">*</span></label>
                        <input type="number" name="starting_price" id="starting_price" class="form-control"
                            value="{{ old('starting_price') }}" placeholder="Enter MRP" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock <span class="text-danger">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}"
                            min="0" placeholder="Enter Stock" required>
                    </div>

                    <div class="form-group">
                        <label for="image_urls">Color Images <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="image_urls[]" class="custom-file-input" id="image_urls"
                                accept="image/jpeg,image/png" multiple required>
                            <label class="custom-file-label" for="image_urls">Choose file</label>
                        </div>
                        <label id="" class="error" for="image_urls"></label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Add Color & Size
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
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                        class="fas fa-home"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Product</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.all') }}">All Products</a></li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"> Add More Custom
                    Fields</a></li>
            {{-- <li class="breadcrumb-item"><a href="#addImageModal" data-toggle="modal" data-target="#addImageModal"> Add
                    More Images</a></li> --}}
            <li class="breadcrumb-item"><a href="#addColorModal" data-toggle="modal" data-target="#addColorModal"> Add
                    More Color & Sizes</a></li>
            <!-- <li class="breadcrumb-item"><a href="#addSizesModal" data-toggle="modal" data-target="#addSizesModal"> Add
                    Sizes</a></li> -->
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Product</h4>
        </div>

        <div class="card-body">
            <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data"
                id="formupdateProduct" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">--Select Category--</option>
                                @foreach($categories as $cate)
                                <option value="{{ $cate->id }}"
                                    {{ $cate->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $cate->pcategory ? $cate->pcategory->name . ' > ' . $cate->name : $cate->name }}
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
                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
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
                            <label for="warranty_id">Warranty</label>
                            <select name="warranty_id" id="warranty_id" class="form-control">
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
                            <label for="gst_id">Gst <span class="text-danger">*</span></label>
                            <select name="gst_id" id="gst_id" class="form-control select2" required>
                                <option value="">--Select Gst--</option>
                                @foreach($gsts as $gst)
                                <option value="{{ $gst->id }}" {{ $product->gst_id == $gst->id ? 'selected' : '' }}>
                                    {{ $gst->gst_value}}%
                                </option>
                                @endforeach
                            </select>
                            <label id="" class="error" for="gst_id"></label>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image_url">Change Front Image </label>
                            <input type="file" name="image_url" id="image_url" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image_url1">Change Back Image </label>
                            <input type="file" name="image_url1" id="image_url1" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upc">UPC </label>
                            <input type="text" name="upc" id="upc" class="form-control" value="{{ $product->upc }}"
                                placeholder="Enter UPC">
                        </div>
                    </div>
                    <!--
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                value="{{ $product->expiry_date }}" placeholder="Select Expiry Date">
                        </div>
                    </div> -->

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
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select Status--</option>
                                <option value="1" {{ $product->status == true ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $product->status == false ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
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


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="offer_id">Offer <span class="text-warning">( Select Any if want to give offer
                                    )</span></label>
                            <select name="offer_id" id="offer_id" class="form-control">
                                <option value="">--Select Offer--</option>
                                @foreach($offers as $ofr)

                                <option value="{{ $ofr->id }}"
                                    {{ $product->offer ? $product->offer->product_id == $product->id ? 'selected' : '' : '' }}>
                                    {{ $ofr->mst_offer->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 offer_div">
                        <div class="form-group">
                            <label for="purchase_quantity">Purchase Quantity <span class="text-danger">*</span></label>
                            <input type="text" name="purchase_quantity" id="purchase_quantity" class="form-control"
                                value="{{ $product->offer ? $product->offer->product_id == $product->id ? $product->offer->purchase_quantity : '' : '' }}"
                                placeholder="Enter Purchase Quantity">
                        </div>
                    </div>

                    <div class="col-md-4 offer_div">
                        <div class="form-group">
                            <label for="offered_quantity">Offered Quantity <span class="text-danger">*</span></label>
                            <input type="text" name="offered_quantity" id="offered_quantity" class="form-control"
                                value="{{ $product->offer ? $product->offer->product_id == $product->id ? $product->offer->offered_quantity : '' : '' }}"
                                placeholder="Enter Offered Quantity">
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

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" rows="8" class="form-control"
                                        required>{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keywords">Keywords </span><span class="text-danger">*</span> <span
                                            class="text-warning">(Use Comma "," to seperate
                                            keywords)</label>
                                    <textarea name="keywords" id="keywords" rows="8" class="form-control"
                                        required>{{ $keywords }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Existing Front Image</label>
                                    <div>
                                        <img src="{{ asset('storage/images/products/' . $product->image_url) }}"
                                            alt="{{ $product->title }}" width="100">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Existing Back Image</label>
                                    <div>
                                        <img src="{{ asset('/storage/images/products/' . $product->image_url1) }}"
                                            alt="{{ $product->title }}" width="100">
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
                                <img data-original="{{ asset('/storage/images/multi-products/' . $image->image_url) }}"
                                    alt="{{ $product->title }}" width="100" class="lazy">
                                <div class="m-l-80 m-t-10">
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
            </form>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                        class="fas fa-home"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Product</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.all') }}">All Products</a></li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"> Add More Custom
                    Fields</a></li>
            {{-- <li class="breadcrumb-item"><a href="#addImageModal" data-toggle="modal" data-target="#addImageModal"> Add
                    More Images</a></li> --}}
            <li class="breadcrumb-item"><a href="#addColorModal" data-toggle="modal" data-target="#addColorModal"> Add
                    More Color & Sizes</a></li>
            <!-- <li class="breadcrumb-item"><a href="#addSizesModal" data-toggle="modal" data-target="#addSizesModal"> Add
                    Sizes</a></li> -->
        </ol>
    </nav>


    <div class="card">
        <div class="card-header">
            <h5>Available Color & Szess for {{ Str::limit($product->title, 20) }}</h5>
        </div>

        @if($product_details)
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>
                            <label for="id">ID </label>
                        </th>
                        <th>
                            <label for="color_id">Colour Name </label>
                        </th>
                        <th>
                            <label for="size_id">Size</label>
                        </th>
                        <th>
                            <label for="mrp">Selling Price</label>
                        </th>
                        <th>
                            <label for="stock">Stock</label>
                        </th>
                        <th>
                            <label for="selling_price">Mrp</label>
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($product_details as $key => $cf)

                    <tr>
                        <td>
                            <input type="number" name="map_id[{{ $key }}]" value="{{ $cf->map_id }}"
                                class="form-control" disabled>
                        </td>

                        <td>
                            <select name="colour_id[{{ $key }}]" class="form-control" required>
                                <option value="">--Select Colour--</option>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}" {{ $cf->color_id == $color->id ? 'selected' : '' }}>
                                    {{ $color->title }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select name="size_id[{{ $key }}]" class="form-control" required>
                                <option value="">--Select Sizes--</option>
                                @foreach($product->sizes as $size)
                                <option value="{{ $size->size_id }}"
                                    {{ $cf->size_id === $size->size_id ? 'selected' : '' }}>
                                    {{ $size->title }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input type="text" name="mrp[{{ $key }}]" value="{{ $cf->mrp }}" class="form-control"
                                id="mrp">
                        </td>

                        <td>
                            <input type="text" name="stock[{{ $key }}]" value="{{ $cf->stock }}" class="form-control"
                                id="stock">
                        </td>

                        <td>
                            <input type="text" name="starting_price[{{ $key }}]"
                                value="{{ $cf->starting_price ? $cf->starting_price : 0 }}" class="form-control"
                                id="selling_price">
                        </td>

                        <td>

                            <div class="dropdown d-inline">
                                <a href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.products.color.edit', $cf->map_id) }}"
                                        class="dropdown-item has-icon" title="Update Detail">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item has-icon update-color-object"
                                        data-object-index="{{ $key }}" title="Update Detail">
                                        <i class="fa fa-save"></i> Update
                                    </a>
                                    {{-- <a href="javascript:void(0)" class="dropdown-item has-icon delete-color-object"
                                        title="Delete" data-object-index="{{ $key }}">
                                    <i class="fa fa-trash text-danger"></i> Delete
                                    </a> --}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>


    <div class="card">
        <div class="card-header">
            <h5>Available Custom Fields for {{ Str::limit($product->title, 20) }}</h5>
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

</section>
<form id="formDelete" method="POST" action="{{ route('admin.products.delete.custom.field') }}">
    @csrf
    <input type="hidden" name="cust_id" id="txtCustID">
</form>

<form id="formColorDelete" method="POST" action="{{ route('admin.products.delete.color') }}">
    @csrf
    <input type="hidden" name="map_id" id="txtMapID">
</form>

<form id="formImageDelete" method="POST" action="{{ route('admin.products.delete.images') }}">
    @csrf
    <input type="hidden" name="image_id" id="txtImageID">
</form>

<form id="formUpdate" method="POST" action="{{ route('admin.products.update.custom.field') }}">
    @csrf
    <input type="hidden" name="field_name" id="txtFieldNameUpdate" />
    <input type="hidden" name="field_value" id="txtFieldValueUpdate" />
    <input type="hidden" name="field_id" id="txtFieldID" />
</form>

<form id="formColorUpdate" method="POST" action="{{ route('admin.products.update.color') }}">
    @csrf
    <input type="hidden" name="color_id" id="txtColorIDUpdate" />
    <input type="hidden" name="size_id" id="txtSizeIDUpdate" />
    <input type="hidden" name="mrp" id="txtMrpUpdate" />
    <input type="hidden" name="stock" id="txtStockUpdate" />
    <input type="hidden" name="starting_price" id="txtStartingPriceUpdate" />
    <input type="hidden" name="map_id" id="txtUpdateMapID" />
</form>

@endsection

@section('extrajs')
<script>
    $(document).ready(function () {

        
            var offer_id = $('#offer_id').val();
            if(offer_id.length > 0){
                $('.offer_div').show();
            }else{

                $('.offer_div').hide();
            }

        $(".delete-object").click(function () {
            if (window.confirm("Are you sure to delete this Custom Field ?")) {
                $('#txtCustID').val($(this).attr("data-obj-id"));
                $("#formDelete").submit();
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            }
        });

        $(".delete-color-object").click(function () {
            if (window.confirm("Are you sure to delete this Color & Size ?")) {

                var key = $(this).attr("data-object-index");
                var id = $("input[name='map_id[" + key + "]']").val();
                $('#txtMapID').val(id);

                $("#formColorDelete").submit();
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            }
        });

        $(".image-delete").click(function () {
            if (window.confirm("Are you sure to delete this Image ?")) {
                $("#txtImageID").val($(this).attr("data-delete-id"));
                $("#formImageDelete").submit();
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            }
        });

        $(".update-object").click(function () {
            var index = $(this).attr("data-object-index");
            var field_id = $("input[name='field_id[" + index + "]']").val();
            $("#txtFieldNameUpdate").val($("input[name='field_name[" + index + "]']").val());
            $("#txtFieldValueUpdate").val($("input[name='field_value[" + index + "]']").val());
            $("#txtFieldID").val(field_id);
            $("#formUpdate").submit();
            $(this).attr('disabled', 'disabled');
            $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        });

        $(".update-color-object").click(function () {
            var key = $(this).attr("data-object-index");
            var id = $("input[name='map_id[" + key + "]']").val();
            $("#txtColorIDUpdate").val($("select[name='colour_id[" + key + "]']").val());
            $("#txtSizeIDUpdate").val($("select[name='size_id[" + key + "]']").val());
            $("#txtMrpUpdate").val($("input[name='mrp[" + key + "]']").val());
            $("#txtStartingPriceUpdate").val($("input[name='starting_price[" + key + "]']").val());
            $("#txtStockUpdate").val($("input[name='stock[" + key + "]']").val());
            $("#txtUpdateMapID").val(id);
            $("#formColorUpdate").submit();
            $(this).attr('disabled', 'disabled');
            $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        });

         $("#offer_id").change(function(){
            var offer_id = $(this).val();
            if(offer_id.length > 0){
                $('.offer_div').show();
            }else{

                $('.offer_div').hide();
            }
        });

        $("#formupdateProduct").validate({
            rules: {
                category_id: {
                    required: true
                },
                title: {
                    required: true
                },
                brand_id: {
                    required: true
                },
                material_id: {
                    required: true
                },
                condition: {
                    required: true
                },

                gst_id: {
                    required: true
                },

                is_cod: {
                    required: true
                },
                description: {
                    required: true
                },
                keywords: {
                    required: true
                },
                purchase_quantity: {
                    required: true
                },
                offered_quantity: {
                    required: true
                },

            },
            messages: {
                category_id: {
                    required: "Please Select Category"
                },
                title: {
                    required: "Please Enter Product Name"
                },
                brand_id: {
                    required: "Please Select Brand"
                },
                material_id: {
                    required: "Please Select Material"
                },
                condition: {
                    required: "Please Select Condition"
                },

                gst_id: {
                    required: "Please Select Gst"
                },

                is_cod: {
                    required: "Please Select COD Availability"
                },
                description: {
                    required: "Please Enter Description of Product"
                },
                keywords: {
                    required: "Please Enter Keywords of Product"
                },
                purchase_quantity: {
                    required: "Please Enter Purchase Quantity"
                },
                offered_quantity: {
                    required: "Please Enter Offered Quantity"
                },

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#formAddColor").validate({
            rules: {

                color_id: {
                    required: true
                },

                "image_urls[]": {
                    required: true
                },

                size_id: {
                    required: true
                },

                mrp: {
                    required: true
                },

                stock: {
                    required: true
                },

                starting_price: {
                    required: true
                },


            },
            messages: {

                color_id: {
                    required: "Please Select Colour"
                },

                size_id: {
                    required: "Please Select Sizes"
                },

                mrp: {
                    required: "Please Enter Selling Price"
                },

                stock: {
                    required: "Please Enter Stock"
                },

                starting_price: {
                    required: "Please Enter MRP"
                },

                "image_urls[]": {
                    required: "Please Upload Colour Images"
                },
                
            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#formAddCustom").validate({
            rules: {

                field_name: {
                    required: true
                },

                field_value: {
                    required: true
                },
            },
            messages: {

                field_name: {
                    required: "Please Enter Field Name"
                },
                field_value: {
                    required: "Please Enter Field Value"
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
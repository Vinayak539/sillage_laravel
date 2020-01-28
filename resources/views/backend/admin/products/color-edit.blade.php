@extends('layouts.admin-master')
@section('title', 'Update Color & Size')
@section('content')


{{-- Image Model --}}

<div class="modal" id="addImageModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add More Images of {{ $product->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.products.add.images', $product->id) }}" method="POST" class="needs-validation"
                enctype="multipart/form-data" id="formAddImage">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="image_urls"> Images <span class="text-danger">*</span></label>
                        <input type="file" name="image_urls[]" class="form-control" id="image_urls"
                            accept="image/jpeg, image/png" multiple required>
                    </div>

                    <input type="hidden" name="color_id" value="{{ $cl->color_id }}">

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

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Update Colour & Size</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.all') }}"> All Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.edit', $cl->product->slug_url) }}"> Go
                    Back</a></li>
            <li class="breadcrumb-item"><a href="#addImageModal" data-toggle="modal" data-target="#addImageModal"> Add
                    More Images</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Colour & Size</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditProduct" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Colour</label>
                            <input type="text" value="{{ $cl->color->title }}" class="form-control" disabled>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Size <span class="text-danger">*</span></label>
                            <select name="size_id" class="form-control" required>
                                <option value="">--Select Sizes--</option>
                                @foreach($product->sizes as $size)
                                <option value="{{ $size->size_id }}"
                                    {{ $cl->size_id === $size->size_id ? 'selected' : '' }}>
                                    {{ $size->title }}
                                </option>
                                @endforeach
                            </select>
                            <label id="" class="error" for="size_id"></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mrp">Selling Price <span class="text-danger">*</span></label>
                            <input type="number" name="mrp" class="form-control" id="mrp"
                                placeholder="Enter Selling Price" value="{{ $cl->mrp }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="starting_price">MRP <span class="text-danger">*</span></label>
                            <input type="number" name="starting_price" class="form-control" id="starting_price"
                                placeholder="Enter MRP" value="{{ $cl->starting_price }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" id="stock" placeholder="Enter Stock"
                                value="{{ $cl->stock }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" id="stock" placeholder="Enter Stock"
                                value="{{ $cl->stock }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $cl->status == true ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $cl->status == false ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="gallery gallery-md">
                                    @foreach($images as $key => $img)
                                    <div class="item">
                                        <div  class="gallery-item" data-image="{!! asset('storage/images/multi-products/'. $img->image_url) !!}" data-title="Image{{ $key }}">
                                        </div>
                                        <button style="position: absolute;margin-left: -85px; z-index: 1;" type="button" class="btn btn-outline-danger btn-sm image-delete"
                                        data-delete-id="{{ $img->id }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
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

<form id="formImageDelete" method="POST" action="{{ route('admin.products.delete.images') }}">
    @csrf
    <input type="hidden" name="image_id" id="txtImageID">
</form>

@endsection

@section('extrajs')

<script src="{!! asset('admin/bundles/chocolat/dist/js/jquery.chocolat.min.js') !!}"></script>
<!-- Page Specific JS File -->
<script src="{!! asset('admin/js/page/gallery1.js') !!}"></script>

<script>
    $(document).ready(function () {

        $(".image-delete").click(function () {
            if (window.confirm("Are you sure to delete this Image ?")) {
                $("#txtImageID").val($(this).attr("data-delete-id"));
                $("#formImageDelete").submit();
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            }
        });

        $("#formEditProduct").validate({
            rules: {

                color_id: {
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
                
                status: {
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

        $("#formAddImage").validate({

            rules: {

                "image_urls[]": {
                    required: true
                },

            },
            messages: {

                "image_urls[]": {
                    required: "Please Choose atleast one image"
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

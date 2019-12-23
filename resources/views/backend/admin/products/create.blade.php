@extends('layouts.admin-master')
@section('title', 'Add Products')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.all') }}"> All Products</a></li>
        </ol>
    </nav>

    <div class="card" ng-app="products">
        <div class="card-header bg-dark text-white-all">
            <h4>Add New Product</h4>
        </div>
        <div class="card-body">
            <form method="POST" role="form" class="needs-validation" id="formAddProduct" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control select2" id="category_id" required>
                                    <option value=""> --Select Category--</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="category_id"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Name <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}" placeholder="Enter Product Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brand_id">Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" id="brand_id" class="form-control select2" required>
                                    <option value="">--Select Brand--</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="brand_id"></label>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="material_id">Material <span class="text-danger">*</span></label>
                                <select name="material_id" id="material_id" class="form-control select2" required>
                                    <option value="">--Select Material--</option>
                                    @foreach($materials as $material)
                                    <option value="{{ $material->id }}"
                                        {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                        {{ $material->material_name }}</option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="material_id"></label>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight_id">Unit </label>
                                <select name="weight_id" id="weight_id" class="form-control select2">
                                    <option value="">--Select Unit--</option>
                                    @foreach($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('weight_id') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->unit }}</option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="weight_id"></label>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="condition_id">Condition <span class="text-danger">*</span></label>
                                <select name="condition_id" id="condition_id" class="form-control select2">
                                    <option value="">--Select Condition--</option>
                                    @foreach($conditions as $condition)
                                    <option value="{{ $condition->id }}"
                                        {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                                        {{ $condition->condition }}</option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="condition_id"></label>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="warranty_id">Warranty <span class="text-danger">*</span></label>
                                <select name="warranty_id" id="warranty_id" class="form-control select2">
                                    <option value="">--Select Warranty--</option>
                                    @foreach($warranties as $warranty)
                                    <option value="{{ $warranty->id }}"
                                        {{ old('warranty_id') == $warranty->id ? 'selected' : '' }}>
                                        {{ $warranty->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="warranty_id"></label>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image_url">Front Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" name="image_url" class="custom-file-input" id="image_url"
                                        required>
                                    <label class="custom-file-label" for="image_url">Choose file</label>
                                </div>
                                <label id="" class="error" for="image_url"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image_url1">Back Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" name="image_url1" class="custom-file-input" id="image_url1"
                                        required>
                                    <label class="custom-file-label" for="image_url1">Choose file</label>
                                </div>
                                <label id="" class="error" for="image_url1"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="upc">UPC </label>
                                <input type="text" name="upc" id="upc" class="form-control" value="{{ old('upc') }}"
                                    placeholder="Enter UPC">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date </label>
                                <input type="text" name="expiry_date" id="expiry_date" class="form-control datepicker"
                                    value="{{ old('expiry_date') }}" placeholder="Select Expiry Date">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="length">Length </label>
                                <input type="text" name="length" id="length" class="form-control"
                                    value="{{ old('length') }}" placeholder="Enter length">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="breadth">Breadth </label>
                                <input type="text" name="breadth" id="breadth" class="form-control"
                                    value="{{ old('breadth') }}" placeholder="Enter breadth">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="height">Height </label>
                                <input type="text" name="height" id="height" class="form-control"
                                    value="{{ old('height') }}" placeholder="Enter height">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="width">Width </label>
                                <input type="text" name="width" id="width" class="form-control"
                                    value="{{ old('width') }}" placeholder="Enter width">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight">Weight </label>
                                <input type="text" name="weight" id="weight" class="form-control"
                                    value="{{ old('weight') }}" placeholder="Enter weight">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_cod">Cod Available <span class="text-danger">*</span></label>
                                <select name="is_cod" id="is_cod" class="form-control">
                                    <option value="">--Select Cod Availability--</option>
                                    <option value="1" {{ old('is_cod') == true ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ old('is_cod') == false ? 'selected' : '' }}>Not Available
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color_id">Colour <span class="text-danger">*</span></label>
                                <select name="color_id" id="color_id" class="form-control select2" required>
                                    <option value="">--Select Colour--</option>
                                    @foreach($colors as $color)
                                    <option value="{{ $color->id }}"
                                        {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                        {{ $color->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="color_id"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="size_id">Sizes <span class="text-danger">*</span></label>
                                <select name="size_id" id="size_id" class="form-control select2" required>
                                    <option value="">--Select Sizes--</option>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                                        {{ $size->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <label id="" class="error" for="size_id"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mrp">MRP <span class="text-danger">*</span></label>
                                <input type="text" name="mrp" id="mrp" class="form-control" value="{{ old('mrp') }}"
                                    placeholder="Enter Mrp" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock">Stock <span class="text-danger">*</span></label>
                                <input type="number" name="stock" id="stock" class="form-control"
                                    value="{{ old('stock') }}" min="0" placeholder="Enter Stock" required>
                            </div>
                        </div>

                        <div class="col-md-4">
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


                        <div class="col-md-8 mb-3">
                            <label>Return Policy <span class="text-danger">*</span></label> <br>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="within_days"
                                        name="within_days" {{ old('within_days') ? 'selected' : '' }} value="1">
                                    <label class="custom-control-label" for="within_days">Within 7 Days</label>
                                </div>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="wrong_products" value="1"
                                        name="wrong_products" {{ old('wrong_products') ? 'selected' : '' }}>
                                    <label class="custom-control-label" for="wrong_products">Wrong Products</label>
                                </div>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="faulty_products" value="1"
                                        name="faulty_products" {{ old('faulty_products') ? 'selected' : '' }}>
                                    <label class="custom-control-label" for="faulty_products">Faulty Products</label>
                                </div>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="quality_issue" value="1"
                                        name="quality_issue" {{ old('quality_issue') ? 'selected' : '' }}>
                                    <label class="custom-control-label" for="quality_issue">Quality Issue</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" rows="5"
                                            class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keywords">Keywords </span><span class="text-danger">*</span> <span
                                                class="text-warning">(Use Comma "," to seperate keywords)</span></label>
                                        <textarea name="keywords" id="keywords" rows="5"
                                            class="form-control">{{ old('keywords') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" ng-controller="productsCtrl">
                            <label>Custom Fields </label>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td colspan="2">
                                            <a href="javascript:void(0)" title="Remove Field"
                                                class="btn-danger btn btn-sm pull-left" ng-click="removefield()">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" title="Add More Field"
                                                class="btn-success btn btn-sm pull-right" ng-click="addfield()">
                                                <i class="fa fa-plus fa-fw text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Field Name</th>
                                        <th>Field Value</th>
                                    </tr>
                                    <tr class="table-row-sizes" ng-repeat="size in sizes track by $index">
                                        <td ng-bind="$index + 1"></td>
                                        <td>
                                            <input type="text" name="field_name[(=:$index:=)]"
                                                ng-value="field_name[$index]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="field_value[(=:$index:=)]"
                                                ng-value="field_value[$index]" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btnSubmit">
                                <i class="fa fa-plus"></i> Add Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>

@endsection

@section('extracss')

<style>
    #category_id+ul.category_div {
        height: 130px;
        overflow-x: auto;
    }

    #section_id {
        height: 155px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 42px !important;
    }
</style>
@endsection

@section('extrajs')

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>

<script>
    $(document).ready(function () {

        $('#buy_it_now_price').on('keyup', function () {
            var gst = $('option:selected', '#gst_id').attr('data-value');
            var gst_value = 1 + (gst / 100);
            var buy_it_now_price = $(this).val();
            var before_gst_price = Math.round(buy_it_now_price / gst_value);
            var gst_amount = Math.round(buy_it_now_price - before_gst_price);
            $('#starting_price').val(before_gst_price);
            $('#gst_amount').val(gst_amount);
        });

        $("#formAddProduct").validate({
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
                warranty_id: {
                   required: true
                },
                image_url: {
                   required: true
                },
                image_url1: {
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
                warranty_id: {
                   required: "Please Select Warranty"
                },
                image_url: {
                   required: "Please Upload Front Image"
                },
                image_url1: {
                   required: "Please Upload Back Image"
                },
                gst_id: {
                   required: "Please Select GST"
                },
                color_id: {
                   required: "Please Select Colour"
                },
                size_id: {
                   required: "Please Select Sizes"
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
                mrp: {
                   required: "Please Enter MRP"
                },
                stock: {
                   required: "Please Enter Stock"
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

    });

    var app = angular.module('products', []);

    app.controller('productsCtrl', function ($scope) {
        $scope.field_name = cleanArray({!! json_encode(old('field_name')) !!});
        $scope.field_value = cleanArray({!! json_encode(old('field_value')) !!});

        function cleanArray(actual) {
            if (actual == null) {
                return [];
            } else {
                return actual;
            }
        }

        function findLongest() {
            Array.prototype.max = function () {
                return Math.max.apply(null, this);
            };
            return [
                $scope.field_name.length,
                $scope.field_value.length,
            ].max();
        }
        $scope.sizes = new Array(findLongest() == 0 ? 1 : findLongest());
        $scope.addfield = function () {
            if ($scope.sizes.length < 10) {
                $scope.sizes.push("");
            } else {
                window.alert("Maximum 10 Fields can be added !");
            }
        }
        $scope.removefield = function () {
            if ($scope.sizes.length > 1) {
                $scope.sizes.pop();
            } else {
                window.alert("Minimum 1 Field is required !");
            }
        }
    });

    app.config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('(=:');
        $interpolateProvider.endSymbol(':=)');
    });

</script>
@endsection
@extends('layouts.admin-master')
@section('title', 'Manage Products')
@section('content')


{{-- Stock Model --}}

<div class="modal" id="updateStockModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title text-light">Update Stock of <span class="product_name"></span></h5>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" class="needs-validation" id="formUpdateStock">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock">Stock <span class="text-danger">*</span></label>
                        <input type="number" required="required" name="stock" value="{{ old('stock') }}"
                            class="form-control" id="stock" placeholder="Enter Stock" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

{{-- Price Model --}}

<div class="modal" id="updatePriceModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light">Update Price of <span class="product_name"></span></h5>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" class="needs-validation" id="formUpdatePrice">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gst_id">GST <span class="text-danger">*</span></label>
                                <select name="gst_id" id="gst_id" class="form-control" required>
                                    <option value="">--Select GST--</option>
                                    @foreach($gsts as $gst)
                                    <option value="{{ $gst->id }}" data-gst-value="{{ $gst->gst_value }}">
                                        {{ $gst->gst_value }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="buy_it_now_price">Selling Price <span class="text-danger">*</span></label>
                                <input type="number" name="buy_it_now_price" id="buy_it_now_price" class="form-control"
                                    value="{{ old('buy_it_now_price') }}" placeholder="Enter Selling Price" min="1"
                                    required>
                                <input type="hidden" name="gst_amount" id="gst_amount">
                                <span class="text-danger error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="starting_price">Price Before GST <span class="text-danger">*</span></label>
                                <input type="number" name="starting_price" id="starting_price" class="form-control"
                                    value="{{ old('starting_price') }}" placeholder="Enter Price Before GST" min="1"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reserve_price">Bid Price <span class="text-danger">*</span></label>
                                <input type="number" name="reserve_price" id="reserve_price" class="form-control"
                                    value="{{ old('reserve_price') }}" placeholder="Enter Bid Price" min="1" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mrp">MRP <span class="text-danger">*</span></label>
                                <input type="number" name="mrp" id="mrp" class="form-control" value="{{ old('mrp') }}"
                                    placeholder="Enter Selling Price" min="1" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Update
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
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Products</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.create') }}"><i class="fas fa-plus"></i> Add
                    Product</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Products</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category Name</th>
                            <th>In Stock</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <a href="{!! asset('storage/images/products').'/' !!}{{ $product->image_url }}"
                                    target="_blank">
                                    <img src="{!! asset('storage/images/products').'/' !!}{{ $product->image_url }}"
                                        alt="{{ $product->title }}" class="img img-responsive img-circle" width="40"
                                        height="40" loading="lazy">
                                </a>
                            </td>
                            <td>{{ Str::limit($product->title, 30) }}</td>
                            @if($product->category)
                            <td>{{ $product->category->name }}</td>
                            @else
                            <td>N/A</td>
                            @endif
                            <td>{{ $product->stock }}</td>

                            <td>
                                {{ $product->status == true ? 'Active' : 'Blocked' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($product->created_at)) }}</td>
                            <td>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.products.edit', $product->slug_url) }}"
                                            class="dropdown-item has-icon" title="Edit Detail">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.products.questions', $product->slug_url) }}"
                                            class="dropdown-item has-icon" title="Questions">
                                            <i class="fa fa-question-circle"></i> Questions
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item has-icon updateStock"
                                            title="Update Stock" data-obj-name="{{ $product->title }}"
                                            data-obj-id="{{ $product->id }}" data-obj-stock="{{ $product->stock }}">
                                            <i class="fa fa-shopping-cart"></i> Update Stock
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item has-icon updatePrice"
                                            title="Update Price" data-obj-name="{{ $product->title }}"
                                            data-obj-id="{{ $product->id }}"
                                            data-obj-sp="{{ $product->buy_it_now_price }}"
                                            data-obj-pbgst="{{ $product->starting_price }}"
                                            data-obj-bp="{{ $product->reserve_price }}"
                                            data-obj-mrp="{{ $product->mrp }}">
                                            <i class="fa fa-credit-card"></i> Update Price
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="9">
                                <h5>No Record Found. </h5>
                            </td>
                        </tr>
                        @endforelse
                        @if($products->total() > 50)
                        <tr class="text-center">
                            <td colspan="9">
                                {{ $products->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category Name</th>
                            <th>In Stock</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endsection
    @section('extrajs')
    <script>
        $(document).ready(function () {

            $('.updateStock').click(function () {
                $('.product_name').html($(this).attr('data-obj-name'));
                $('#stock').val($(this).attr('data-obj-stock'));
                var action = '/adrana951/manage-products/update-stock/' + $(this).attr('data-obj-id');
                $('#formUpdateStock').attr('action', action);
                $('#updateStockModal').modal('show');
            });

            $('.updatePrice').click(function () {

                $('#buy_it_now_price').val($(this).attr('data-obj-sp'));
                $('#starting_price').val($(this).attr('data-obj-pbgst'));
                $('#reserve_price').val($(this).attr('data-obj-bp'));
                $('#mrp').val($(this).attr('data-obj-mrp'));
                $('.product_name').html($(this).attr('data-obj-name'));
                $('#stock').val($(this).attr('data-obj-stock'));
                var action = '/adrana951/manage-products/update-price/' + $(this).attr('data-obj-id');
                $('#formUpdatePrice').attr('action', action);
                $('#updatePriceModal').modal('show');
            });

            $('#buy_it_now_price').on('keyup', function () {
                var vgst = $('option:selected', '#gst_id').val();
                var gst = $('option:selected', '#gst_id').attr('data-gst-value');
                if (vgst == "") {
                    $('#gst_id').focus();
                    $('.error').css('display', 'block');
                    $('.error').html('First Select GST');
                    setTimeout(function () {
                        $('.error').fadeOut();
                    }, 2000);
                } else {
                    var gst = $('option:selected', '#gst_id').attr('data-gst-value');
                    var gst_value = 1 + (gst / 100);
                    var buy_it_now_price = $(this).val();
                    var before_gst_price = Math.round(buy_it_now_price / gst_value);
                    var gst_amount = Math.round(buy_it_now_price - before_gst_price);
                    $('#starting_price').val(before_gst_price);
                    $('#gst_amount').val(gst_amount);
                }

            });

        });

    </script>
    @endsection

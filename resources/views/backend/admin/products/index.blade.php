@extends('layouts.admin-master')
@section('title', 'Manage Products')
@section('content')

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
                                <a href="{!! asset('storage/images/products/'. $product->image_url) !!}"
                                    target="_blank">
                                    <img data-original="{!! asset('storage/images/products/'. $product->image_url) !!}"
                                        alt="{{ $product->title }}" class="img img-responsive img-circle lazy" width="40"
                                        height="40" loading="lazy">
                                </a>
                            </td>
                            <td>{{ Str::limit($product->title, 30) }}</td>
                            @if($product->category)
                            <td>{{ $product->category->name }}</td>
                            @else
                            <td>N/A</td>
                            @endif
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
                                        {{-- <a href="{{ route('admin.products.questions', $product->slug_url) }}"
                                        class="dropdown-item has-icon" title="Questions">
                                        <i class="fa fa-question-circle"></i> Questions
                                        </a> --}}
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
@extends('layouts.admin-master')
@section('title', 'Manage Offers')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" role="form" class="form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" id="category_id" required>
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
                                <label for="product_id">Product <span class="text-danger">*</span></label>
                                <select name="product_id" class="form-control" id="product_id" required>
                                    <option value=""> --Select Category First--</option>

                                </select>
                            </div>
                            <label id="" class="error" for="product_id"></label>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="offer_product_id">Offer Product <span class="text-danger">*</span></label>
                                <select name="offer_product_id" class="form-control" id="offer_product_id" required>
                                    <option value=""> --Select Offer Product--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('offer_product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label id="" class="error" for="offer_product_id"></label>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="offer_color_id">Offer Colour <span class="text-danger">*</span></label>
                                <select name="offer_color_id" class="form-control" id="offer_color_id" required>
                                    <option value=""> --Select Offer Product First --</option>

                                </select>
                            </div>
                            <label id="" class="error" for="offer_color_id"></label>
                        </div>
                    </div>

                    <div class="col-md-12 text-danger">
                        Note : All * Mark Fields are Compulsory !
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary update_button">
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
                        class="fas fa-plus"></i> Add Offer</a></li>
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
                            <th>Product</th>
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
                            <td>{{ $offer->product_id }}</td>
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
                                            <i class="fa fa-edit text-primary"></i> Edit
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
                            <th>Product</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <form id="formDelete" method="POST" action="{{ route('admin.offers.delete') }}">
        @csrf
        <input type="hidden" name="offer_id" id="txtOfferID">
    </form>

</section>

@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                $('#txtShopID').val($(this).attr("data-obj-id"));
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });

        $('#category_id').change(function () {
            var catID = $(this).val();
            console.log('Category Id', catID)
        });
    });

</script>
@endsection

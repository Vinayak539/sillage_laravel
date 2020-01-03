@extends('layouts.admin-master')
@section('title', 'Manage Shops')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Shop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" role="form" class="form">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter Shop Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}"
                                    placeholder="Enter City" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}" placeholder="Enter Shop Address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control"
                                    value="{{ old('mobile') }}" placeholder="Enter Mobile Number" minlength="8"
                                    min="0000000000" maxlength="6" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" placeholder="Enter Email ID" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') }}" placeholder="Enter Password" required>
                            </div>
                        </div>

                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
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
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Shops</li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add
                    Shop</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Shops</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Mobile</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shops as $shop)
                        <tr>
                            <td>{{ $shop->shop_code }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->city }}</td>
                            <td>{{ $shop->mobile }}</td>
                            <td>{{ $shop->total ? $shop->total : '0' }}</td>
                            <td>
                                {{ $shop->status == true ? 'Active' : 'Blocked' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($shop->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.shops.edit', $shop->id) }}" class="dropdown-item"
                                            title="Edit Detail">
                                            <i class="fa fa-edit text-primary"></i> Edit
                                        </a>
                                        {{-- <a href="{{ route('admin.shops.coupons', $shop->id) }}"
                                        class="dropdown-item" title="Generate Coupon">
                                        <i class="fa fa-tags text-primary"></i> Generate Coupons
                                        </a> --}}
                                        {{--  <button type="button" data-role="delete-obj" data-obj-id="{{$shop->id}}"
                                        class="dropdown-item delete-object" title="Delete Shop">
                                        <i class="fa fa-trash text-danger"></i> Delete
                                        </button> --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="8">
                                <h4>No Shops Found..</h4>
                            </td>
                        </tr>
                        @endforelse
                        @if($shops->total() > 50)
                        <tr class="text-center">
                            <td colspan="8">
                                {{ $shops->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Mobile</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <form id="formDelete" method="POST" action="{{ route('admin.shops.delete') }}">
        @csrf
        <input type="hidden" name="shop_id" id="txtShopID">
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
    });

</script>
@endsection

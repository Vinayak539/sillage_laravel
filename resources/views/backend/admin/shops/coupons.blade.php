@extends('layouts.admin-master')
@section('title', 'Manage Coupon')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Generate Discount Coupon</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <form action="/adsillage753/manage-shops/generate-coupon/{{$shop->id}}" method="POST" class="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_of_coupon"> No of Coupon Code</label>
                        <input type="number" required="required" name="no_of_coupon" value="{{ old('no_of_coupon') }}"
                            class="form-control" id="no_of_coupon" placeholder="Enter No of Coupon to be Generate"
                            min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary update_button">
                        <i class="fa fa-plus"></i> Generate Coupon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Coupon</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adsillage753">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.shops.all') }}">All Shops</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal">Generate Coupons</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 bg-white pt-20">
                <h2 class="text-dark mb-30">Shop Information</h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Shop ID</th>
                            <td>{{ $shop->id }}</td>
                        </tr>
                        <tr>
                            <th>Shop Name</th>
                            <td>{{ $shop->name }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $shop->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $shop->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $shop->address }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $shop->city }}</td>
                        </tr>
                        <tr>
                            <th>Added On</th>
                            <td>{{ date('d/m/Y h:i A' , strtotime($shop->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $shop->status == true ? 'Active' : 'Blocked' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 bg-white pt-20">
                <div class="row mb-30">
                    <div class="col-md-6">
                        <h2 class="text-dark ">All Coupons</h2>
                    </div>
                    @if(count($shop->coupons))
                    <div class="col-md-3">
                        <form action="{{ route('admin.shops.download.pdf', $shop->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-file-pdf-o"></i>
                                Download Coupons(PDF)</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('admin.shops.download.excel', $shop->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-file-excel-o"
                                    aria-hidden="true"></i> Download Coupons(Excel)</button>
                        </form>
                    </div>
                    @endif
                </div>

                <div class="row">
                    @forelse($shop->coupons as $code)
                    <div class="col-md-2 coupon">
                        <span>{{ $code->dis_code }}</span>
                    </div>
                    @empty
                    <div class="col-md-12 text-center">
                        <h4 class="text-danger">No Coupon Generated yet.. </h4>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extracss')

<style>
    .coupon span {
        font-size: 18px;
    }

</style>

@endsection

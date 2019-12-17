@extends('layouts.admin-master')
@section('title', 'Manage Orders')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Orders</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.orders.all') }}">All Orders</a>
                </li>
                @if(!$order->shipping)
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal">Add shipment Detail</a>
                </li>
                @endif
                <li class="breadcrumb-item">
                    <a href="#generateModal" data-toggle="modal" data-target="#generateModal">Generate Label</a>
                </li>
            </ul>
        </div>
    </div>
</div>


{{-- Assign Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Add Shipment Detail</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.orders.assign', $order->id) }}" role="form"
                class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="awf_number">AWF Number <span class="text-danger">*</span></label>
                                <input type="text" name="awf_number" id="awf_number" class="form-control"
                                    value="{{ old('awf_number') }}" placeholder="Enter Awf Number" required>
                            </div>
                        </div>

                        @if($order->status != 'delivered')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">--Select Status--</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                        Shipped
                                    </option>
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipping_id">Shipping Company <span class="text-danger">*</span></label>
                                <select name="shipping_id" id="shipping_id" class="form-control">
                                    <option value="">--Select Shipping Company--</option>
                                    @foreach($shippings as $shipping)
                                    <option value="{{ $shipping->id }}" {{ old('shipping_id') ? 'selected' : '' }}>
                                        {{ $shipping->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="delivery_date">Delivery Date <span class="text-danger">*</span></label>
                                <input type="date" name="delivery_date" id="delivery_date" class="form-control"
                                    value="{{ old('delivery_date') }}" required>
                            </div>
                        </div>

                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

{{-- Charges Model --}}

<div class="modal" id="updateChargesModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Update Charges Detail</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.orders.charges') }}" role="form" class="needs-validation"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="packing_price">Packing Price <span class="text-danger">*</span></label>
                                <input type="number" name="packing_price" id="packing_price" class="form-control"
                                    value="{{ old('packing_price') }}" placeholder="Enter Packing Price" required
                                    min="0">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="other_charges">Other Charges <span class="text-danger">*</span></label>
                                <input type="number" name="other_charges" id="other_charges" class="form-control"
                                    value="{{ old('other_charges') }}" min="0" placeholder="Enter Other Charges"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="shipping_charges">Shipping Charges <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="shipping_charges" id="shipping_charges" class="form-control"
                                    value="{{ old('shipping_charges') }}" min="0" placeholder="Enter Shipping Charges"
                                    required>
                            </div>
                        </div>
                        <input type="hidden" name="order_details_id" id="order_details_id">
                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

{{-- Genrate Label Model --}}

<div class="modal" id="generateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Generate Label</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="GET" action="{{ route('admin.orders.generate-label', $order->id) }}" role="form"
                class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="to_label">To Label <span class="text-danger">*</span></label>
                                <textarea name="to_label" id="to_label" rows="5" class="form-control summernote"
                                    required placeholder="Write To Label">{{ old('to_label') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="from_label">From Label (start from Address) <span
                                        class="text-danger">*</span></label>
                                <textarea name="from_label" id="from_label" rows="5" class="form-control summernote"
                                    required placeholder="Write From Label">{{ old('from_label') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 bg-white pt-20">
                <h2 class="text-dark mb-30">Contact Information</h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $order->user_name }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $order->user->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $order->address }}</td>
                        </tr>
                        @if($order->landmark)
                        <tr>
                            <th>Landmark</th>
                            <td>{{ $order->landmark }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>City</th>
                            <td>{{ $order->city }}</td>
                        </tr>
                        <tr>
                            <th>Territory</th>
                            <td>{{ $order->territory }}</td>
                        </tr>
                        <tr>
                            <th>Pincode</th>
                            <td>{{ $order->pincode }}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ date('d/m/Y h:i A' , strtotime($order->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>
                                {{ $order->discount }}
                            </td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>
                                {{ $order->payment_status }}
                            </td>
                        </tr>
                        <tr>
                            <th>Used Ranayas Coins</th>
                            <td>
                                {{ $order->used_royalty_points ? $order->used_royalty_points : 0 }}
                            </td>
                        </tr>
                        <tr>
                            <th>Got Ranayas Coins</th>
                            <td>
                                {{ $order->reward_points ? $order->reward_points / 2 : 'Product Yet to Delivered' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td>
                                {{ $order->payment_mode }}
                            </td>
                        </tr>
                        <tr>
                            <th>Order Status</th>
                            <td>
                                <h6 class="text-info text-capitalize">{{ $order->status }}</h6>
                                @if($order->status != 'delivered')
                                <div class="mt-10">
                                    <form action="{{ route('admin.orders.show' , $order->id) }}" method="post"
                                        class="form form-inline">
                                        @csrf
                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">--Select Status--</option>
                                                <option value="pending"
                                                    {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="booked"
                                                    {{ $order->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                                <option value="shipped"
                                                    {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="delivered"
                                                    {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                                </option>
                                                <option value="Order Cancel By Buyer"
                                                    {{ $order->status == 'Order Cancel By Buyer' ? 'selected' : '' }}>
                                                    Order Cancel By Buyer
                                                </option>
                                                <option value="Order Cancel By Seller"
                                                    {{ $order->status == 'Order Cancel By Seller' ? 'selected' : '' }}>
                                                    Order Cancel By Seller
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btnSubmit">Update
                                            Status</button>
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @if($order->status === 'delivered' && $order->delivery_date)
                        <tr>
                            <th>Delivered At</th>
                            <td>{{ date('d/m/Y h:i A' , strtotime($order->delivery_date)) }}</td>
                        </tr>
                        @endif
                        @if(!empty($order->return_status) && $order->return_status != 'Approved' &&
                        $order->return_status != 'Reject')
                        <tr>
                            <th>Return Status</th>
                            <td>
                                {{ $order->return_status }}
                                <div class="mt-10">
                                    <form action="{{ route('admin.orders.return-status' , $order->id) }}" method="post"
                                        class="form-inline">
                                        @csrf
                                        <div class="form-group">
                                            <select name="return_status" id="return_status" class="form-control">
                                                <option value="">--Select Status--</option>
                                                <option value="Applied"
                                                    {{ $order->return_status=='Applied'? 'selected' : '' }}>
                                                    Applied
                                                </option>
                                                <option value="In Progress"
                                                    {{ $order->return_status=='In Progress'? 'selected' : '' }}>
                                                    In Progress
                                                </option>
                                                <option value="Approved"
                                                    {{ $order->return_status=='Approved'? 'selected' : '' }}>
                                                    Approved
                                                </option>
                                                <option value="Rejected"
                                                    {{ $order->return_status=='Rejected'? 'selected' : '' }}>
                                                    Rejected
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if(!empty($order->return_status))
                        <tr>
                            <th>Return Status</th>
                            <td>
                                {{ $order->return_status }}
                            </td>
                        </tr>
                        <tr>
                            <th>Reason</th>
                            <td>
                                {{ $order->cancel_reason }}
                            </td>
                        </tr>
                        @endif
                        @if($order->other_reason)
                        <tr>
                            <th>other Reason</th>
                            <td>
                                {{ $order->other_reason }}
                            </td>
                        </tr>
                        @endif
                        @if($order->image_url)
                        <tr>
                            <th>Image Uploaded</th>
                            <td>
                                <a href="/storage/images/order-returns/{{ $order->image_url }}" target="_blank">
                                    <img src="/storage/images/order-returns/{{ $order->image_url }}"
                                        alt="Return Product Image" width="50">
                                </a>
                            </td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>

            <div class="col-md-12 bg-white pt-20 table-responsive">
                <h2 class="text-dark mb-30">Order Information</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Add Charges</th>
                            <th>Product Name</th>
                            <th>MRP</th>
                            <th>Purchasing Amt</th>
                            <th>Quantity</th>
                            <th>Packaging Amt</th>
                            <th>Other Chrg</th>
                            <th>Shipping Chrg</th>
                            <th>P/L</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order->details as $detail)

                        <tr>
                            <td>
                                <button data-obj-id="{{ $detail->id }}" id="charges">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                            <td>
                                <a href="javascript:void(0)" title="{{ $detail->product->title }}">
                                    {{ str_limit($detail->product->title, 25) }}
                                </a>
                            </td>
                            <td>{{ $detail->mrp }}</td>
                            <td>{{ $detail->purchasing_price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->packing_price }}</td>
                            <td>{{ $detail->other_charges }}</td>
                            <td>{{ $detail->shipping_charges }}</td>
                            <td>{{ $detail->pnl }}</td>
                            <td>{{ $detail->total }}</td>
                        </tr>

                        @endforeach

                        <tr>
                            <th colspan="10" class="bg-silver text-right text-uppercase">
                                <p>Total Amount : &#8377; {{ $order->tbt }}</p>
                                <p>+ CGST : &#8377; {{ $order->tax/2 }}</p>
                                <p>+ SGST : &#8377; {{ $order->tax/2 }}</p>
                                <p>- Discount : &#8377; {{ $order->discount }}</p>
                                @if($order->used_royalty_points)
                                <p>- Ranayas Coins : &#8377; {{ $order->used_royalty_points }}</p>
                                @endif
                                <p>Grand Total : &#8377; {{ $order->total }}</p>
                            </th>
                        </tr>
                    </tbody>

                </table>
            </div>

            @if($order->shipping)
            <div class="col-md-12 bg-white pt-20">
                <h2 class="text-dark mb-30">Shipping Information</h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>AWF Number</th>
                            <td>{{ $order->awf_number }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Partner ID</th>
                            <td>{{ $order->shipping->id }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Partner Name</th>
                            <td>{{ $order->shipping->name }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Website Url</th>
                            <td>
                                <a href="{{ $order->shipping->website_url }}" target="_blank">
                                    {{ $order->shipping->website_url }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif

            @if($order->transaction)
            <div class="col-md-12 bg-white pt-20">
                <h2 class="text-dark mb-30">Transaction Details</h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Merchant ID</td>
                            <td>{{$order->transaction->MID}}</td>
                        </tr>
                        <tr>
                            <td>Transaction ID</td>
                            <td>{{$order->transaction->TXNID}}</td>
                        </tr>
                        <tr>
                            <td>Transaction Amount</td>
                            <td>{{$order->transaction->TXNAMOUNT}}</td>
                        </tr>
                        <tr>
                            <td>Payment Mode</td>
                            <td>{{$order->transaction->PAYMENTMODE}}</td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>{{$order->transaction->CURRENCY}}</td>
                        </tr>
                        <tr>
                            <td>Transaction Date</td>
                            <td>{{date('d-M-Y h:i A', strtotime($order->transaction->TXNDATE))}}</td>
                        </tr>
                        <tr>
                            <td>Transaction Status</td>
                            <td>{{$order->transaction->STATUS}}</td>
                        </tr>
                        <tr>
                            <td>Response Code</td>
                            <td>{{$order->transaction->RESPCODE}}</td>
                        </tr>
                        <tr>
                            <td>Response Message</td>
                            <td>{{$order->transaction->RESPMSG}}</td>
                        </tr>
                        <tr>
                            <td>Gateway Name</td>
                            <td>{{$order->transaction->GATEWAYNAME}}</td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td>{{$order->transaction->BANKNAME}}</td>
                        </tr>
                        <tr>
                            <td>Checksum Hash</td>
                            <td>{{$order->transaction->CHECKSUMHASH}}</td>
                        </tr>
                        <tr>
                            <td>Bank Transaction ID</td>
                            <td>{{$order->transaction->BANKTXNID}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
@section('extrajs')

<script>
    $(document).ready(function () {
        $('#charges').click(function () {
            $('#updateChargesModal').modal('show');
            $('#order_details_id').val($(this).attr('data-obj-id'));

        });
    });

</script>

@endsection
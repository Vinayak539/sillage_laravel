@extends('layouts.master') @section('title','Orders') @section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Orders</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Orders</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->


{{-- Model --}}

<div class="modal fade" id="orderReturn">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Return Order</h4>
                <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" role="form" class="form" id="returnForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reason">Select Reason <span class="text-danger">*</span></label>
                                    <select name="reason" id="reason" class="form-control" required>
                                        <option value="">--Select Reason--</option>
                                        <option value="Within 7 Days"
                                            {{ old('reason') == 'Within 7 Days' ? 'selected' : '' }}>Within 7 Days
                                        </option>
                                        <option value="Wrong Products"
                                            {{ old('reason') == 'Wrong Products' ? 'selected' : '' }}>Wrong Products
                                        </option>
                                        <option value="Faulty Products"
                                            {{ old('reason') == 'Faulty Products' ? 'selected' : '' }}>Faulty Products
                                        </option>
                                        <option value="Quality Products"
                                            {{ old('reason') == 'Quality Products' ? 'selected' : '' }}>Quality Products
                                        </option>
                                        <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 other_reason">
                                <div class="form-group">
                                    <label for="other_reason">Write Reason <span class="text-danger">*</span></label>
                                    <textarea name="other_reason" id="other_reason" class="form-control"
                                        rows="5">{{ old('other_reason') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_url">Upload Product Image</label>
                                    <input type="file" name="image_url" id="image_url" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12 text-danger">
                                Note : All * Mark Fields are Compulsory !
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary button_update">
                            <i class="fa fa-plus"></i> Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Model End --}}

{{-- Help Model --}}

<div class="modal fade" id="orderHelp">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Need Help ? </h4>
                <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" role="form" class="form" id="helpForm" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Write your query <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="5"
                                        required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-danger">
                                Note : All * Mark Fields are Compulsory !
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary button_update">
                            <i class="fa fa-plus"></i> Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Help Model End --}}



<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">
            <div class="row ptb--40 ptb-md--30 ptb-sm--20">
                <div class="col-lg-12 mb-sm--25">
                    @forelse($user->orders as $order)
                    <div class="order-bordered mt-5 mb-20">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('user.order', $order->id) }}" class="order-btn">{{ $order->id }}</a>
                                <a href="{{ route('user.invoices.download', $order->id) }}"
                                    class="download-btn float-right">Download Invoice</a>
                            </div>
                            @php $statusBoolean = true @endphp

                            @foreach($order->details as $detail)

                            @php 
                                $image = \App\Model\TxnImage::image($detail->product_id, $detail->color_id);
                            @endphp
                            <div class="col-md-12 mt--10">
                                <div class="order_sec">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="pro_sec">
                                                <div class="img">
                                                    <img class="lazy" data-src="{!! asset('/storage/images/multi-products/' . $image->image_url) !!}"
                                                        alt="{{ $detail->product->title }}" />
                                                </div>
                                                <div class="content">
                                                    <p class="title">
                                                        {{ $detail->product->title }}

                                                    </p>
                                                    <p>
                                                        {{ $detail->size ? 'Size: ' . $detail->size->title : '' }} <br>
                                                        {{ $detail->color ? 'Colour: ' . $detail->color->title : '' }}
                                                    </p>
                                                    <p>
                                                        Price :
                                                        {{ $detail->mrp }}
                                                    </p>
                                                    <p>
                                                        Qty :
                                                        {{ $detail->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="price">
                                                &#8377; {{ $detail->mrp * $detail->quantity }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            @if($order->delivery_date)
                                            <p class="delivery">
                                                Delivered by
                                                {{ date('M, d', strtotime($order->delivery_date
                                                            )) }}
                                            </p>
                                            @endif
                                            @if($statusBoolean)
                                            @php $statusBoolean = false @endphp
                                            <p class="padding10">
                                                Order Status: <strong>
                                                    {{ $order->status }}
                                                </strong>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-12">
                                <div class="review-sec mt--20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="date" style="line-height: 20px;">
                                                Order On <br />
                                                <strong>{{ date('d M \'y h:i A', strtotime($order->created_at)) }}</strong>
                                            </p>
                                        </div>
                                        @if($order->return_status === null &&
                                        $order->status === 'Delivered' &&
                                        $order->status !== 'Cancelled')
                                        <div class="col-sm-3">
                                            <a href="javascript:void(0)" class="return-btn"
                                                data-obj-id="{{ $order->id }}">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                                Return
                                            </a>
                                        </div>
                                        @endif @if($order->return_status ===
                                        null && $order->status != 'Delivered' &&
                                        $order->status != 'Cancelled') @if($order->status != 'Shipped')
                                        <a href="javascript:void(0);" class="cancelBtn" data-obj-id="{{ $order->id }}">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Cancel
                                        </a>
                                        @else
                                        <a href="javascript:void(0);" class="cancelBtn" data-obj-id="{{ $order->id }}">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Cancel
                                        </a>
                                        <p>
                                            <strong class="text-danger">
                                                Note : Extra Shipping Charges
                                                will be charged.
                                            </strong>
                                        </p>
                                        @endif @endif
                                        <div class="col-sm-3">
                                            <a href="javascript:void(0)" class="need-help-btn"
                                                data-obj-id="{{ $order->id }}">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                Need Help
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty There are no orders yet. @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<form id="formCancel" method="POST" action="{{ route('user.orders.cancel') }}">
    @csrf
    <input type="hidden" name="order_id" id="txtCancelOrder">
</form>

@endsection
@section('extracss')
<style>img.lazy {
    width: 100%;
    min-height: 76px;
    max-height: 76px;
    background: #fff url("{{ asset('assets/img/loader.gif') }}") no-repeat 50% 50% !important;
    display: block;
}</style>
@endsection
@section('extrajs')

<script>
    $(document).ready(function () {
        $('.return-btn').click(function () {
            var id = $(this).attr('data-obj-id');
            var action = '/myaccount/order/return/' + id;
            $('#returnForm').attr('action', action);
            $('#orderReturn').modal('show');
        });

        $('.need-help-btn').click(function () {
            var id = $(this).attr('data-obj-id');
            var action = '/myaccount/order/help/' + id;
            $('#helpForm').attr('action', action);
            $('#orderHelp').modal('show');
        });

        $('.cancelBtn').click(function () {
            if (window.confirm('Are you sure want to cancel order ?')) {
                $("#txtCancelOrder").val($(this).attr("data-obj-id"));
                $("#formCancel").submit();
                $(this).attr('disabled', 'disabled');
                $(this).html(
                    '<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>'
                );
            }
        });
    });

</script>

@endsection

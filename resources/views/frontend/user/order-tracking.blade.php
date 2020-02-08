@extends('layouts.master') @section('title','Orders Tracking') @section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Order Tracking Of  #{{ $order->id }}</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('user.showOrder') }}">Orders</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div id="content" class="main-content-wrapper order-details">
    <div class="page-content-inner">
        <div class="container">
            <div class="personal-detail">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('user.order',$order->id) }}" class="pull-left mt-0 mb-3"> <i
                                class="fa fa-angle-double-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white-all">
                                <h4 class="text-white">Order Tracking</h4>
                            </div>
                            <div class="card-body table-responsive">
                                @if($track_response)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                <span class="pull-left text-dark">Order Pickedup Origin :
                                                    {{ $track_response['Origin'] }}</span> <Span class="pull-right text-dark">Order
                                                    Pickedup
                                                    Date :
                                                    {{ date('d-M-Y h:i A', strtotime($track_response['PickUpDate'])) }}</Span></th>
                                        </tr>
                    
                                        <tr class="thead-dark">
                                            <th>Instructions</th>
                                            <th>Location</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    @if($track_response['Scans'])
                                    <tbody>
                                        @foreach($track_response['Scans'] as $scan)
                                        <tr>
                                            <td>
                                                {{ $scan['ScanDetail']['Instructions'] }}
                                            </td>
                                            <td>
                                                {{ $scan['ScanDetail']['ScannedLocation'] }}
                                            </td>
                                            <td>
                                                {{ date('d-M-Y h:i A', strtotime($scan['ScanDetail']['StatusDateTime'])) }}
                                            </td>
                                            <td>
                                                {{ $scan['ScanDetail']['Scan'] }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

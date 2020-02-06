@extends('layouts.master') 
@section('title','Transaction Failed') 
@section('content')

<div class="element-section">
    <div class="breadcrumbs-bg-image theme-breadcrumbs" style="background-image: url(/assets/images/bg/common-bg.jpg);">
        <div class="container">
            <div class="d-md-flex align-items-center justify-content-between">
                <h2 class="page-title">Transaction Failed</h2>
                <ul class="page-breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li>Transaction Failed</li>
                </ul>
            </div>
        </div> <!-- /.container -->
    </div> <!-- /.breadcrumbs-bg-image -->
</div>

<section class="checkout-section">
    <div class="container">
        <div class="row">
            @if(isset($data))
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <div class="well-lg">
                        <h3 class="text-danger">Oops, Transaction failed !</h3>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                @foreach($data as $dkey => $dval)
                <tr>
                    <th>{{$dkey}}</th>
                    <th>{{$dval}}</th>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
</section>
@endsection @section('extrajs')
<script>
fbq('track', 'ViewContent', { content_name: 'Transaction Failed' });
</script>
@endsection
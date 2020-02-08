@extends('layouts.master') 
@section('title','Transaction Failed') 
@section('content')
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span> Transaction Failed </span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="checkout-section pt--40">
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
@endsection @section('extracss')
<style>
    .table {
        margin: 15px;
    }
    .table td, .table th {
        padding: .75rem;
        font-weight: 600;
        font-size: 14px;
    }
    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
    }
</style>
@endsection @section('extrajs')
<script>
fbq('track', 'ViewContent', { content_name: 'Transaction Failed' });
</script>
@endsection
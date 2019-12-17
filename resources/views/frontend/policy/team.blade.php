@extends('layouts.master')
@section('title','Team')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Team</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="current"><span>Team</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb area End -->

        

@endsection
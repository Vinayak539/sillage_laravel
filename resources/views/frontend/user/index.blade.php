@extends('layouts.master') @section('title','Dashboard') @section('content')

<!-- Breadcrumb area Start -->
<div
    class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40"
>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Dashboard</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">
            <div class="row ptb--40 ptb-md--30 ptb-sm--20">
                <div class="col-lg-12 mb-sm--25">
                    <div class="about-text">
                        <h3 class="heading-tertiary heading-color mb--20">
                           Hi {{ $user->name }},
                        </h3>
                        <h3>Welcome to the <strong>hnilifestyle.com</strong></h3>
                        @if($user->last_login)
                        <p>
                            Last Login on
                            <strong
                                >{{ $user->last_login->diffForHumans() }}</strong
                            >
                        </p>
                        @endif
                       
                        @if($user->last_purchase)
                        <p>
                            Your last purchase on
                            <strong
                                >{{ $user->last_purchase->diffForHumans() }}</strong
                            >
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

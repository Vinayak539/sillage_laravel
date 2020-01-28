@extends('layouts.master')
@section('title','About')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">About Us</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>About Us</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">
            <div class="row ptb--40 ptb-md--30 ptb-sm--20">
                <div class="col-lg-6 offset-lg-1 col-md-6 order-md-2 mb-sm--25">
                    <div class="about-text">
                        <h3 class="heading-tertiary heading-color mb--20">Invest in yourself to get the best Returns
                        </h3>
                        <p class="mb-20"><strong class="text-color-primary">HNILIFESTYLE</strong> is operated by
                            <strong>KHUSHI NATURALS</strong>, a partnership company. Started by 3
                            partners <strong>Mr.Bharat Joshi</strong>, <strong>Mr.Hitesh Dewda</strong> and
                            <strong>Mrs.Bhavna Dewda</strong> who are passionate for Perfumes
                            and Cosmetics. </p>
                        <p> In business world <strong class="text-color-primary">HNI</strong> stands for <strong
                                class="text-color-primary">“High Net worth Investor or Individual“</strong>. HNIs are
                            Individuals
                            who think intelligently and invest smartly in Projects and Stocks to make Good Fortunes. For
                            us
                            <strong class="text-color-primary">HNI</strong> stands for <strong
                                class="text-color-primary">“Highly Natural Investor”</strong>. We strongly believe
                            <strong>“Invest in yourself to get the
                                best Returns”</strong> investing in one’s Health and Mind.
                        </p>

                        <h3 class="heading-tertiary heading-color mb--20">HNI stands for “Highly Natural Investor”</h3>
                        <p>Today market is flooded with Perfume and Cosmetic Manufacturers who rampantly uses Harmful
                            Chemicals
                            to make Cosmetic Products. Such Harmful chemicals can make person sick or give Life –
                            Threatening
                            Diseases. This chemicals are equally Harmful for Humans and environment as pollution from
                            Industries
                            and Vehicles.</p>
                        <p>India is the country which gave Yoga and Ayurveda to the world. Ayurveda is more than 5000yrs
                            old and has methods and preparations for Human Skin. Each one of us has full right to look
                            Beautiful and Gorgeous. </p>
                        <p>Hence after referring to Ayurveda Literatures and combining it with Modern Science we are
                            bringing range of Safe and effective Cosmetics for our customers.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 order-md-1">
                    <figure class="image-box image-box-w-video-btn btn-right max-w-sm-65 max-w-xs-100">
                        <img src="{!! asset('assets/img/about/about-bg3.jpg') !!}" alt="about">
                    </figure>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->



@endsection
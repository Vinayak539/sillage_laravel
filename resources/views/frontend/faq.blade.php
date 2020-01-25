@extends('layouts.master')
@section('title','FAQ')
@section('content')

  <!-- Breadcrumb area Start -->
  <div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">FAQs</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="current"><span>FAQs </span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb area End -->

        <!-- Main Content Wrapper Start -->
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="faq-bg"></div>
                        </div>
                        <div class="col-md-8 mt--100 mt-lg--80 mt-md--60 pb--5">
                            <div class="accordion-container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @forelse($faqs as  $key=>$faq)
                                        <div class="accordion__single mb--30 mb-lg--40 mb-md--55 mb-sm--30">
                                            <div class="accordion__header" id="heading{{$key}}">
                                                <a class="accordion__link" data-target="#accordion{{$key}}">
                                                    {{ $faq->question }}
                                                </a>
                                            </div>
                                            <div id="accordion{{$key}}" class="accordion__body">
                                                <div class="accordion__text">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-warning">
                                            <h5>Comming Soon.</h5>
                                        </div>
                                        @endforelse
                                    </div>
                                    @if($faqs->total() > 6)
                                    <div class="col-lg-12">
                                        {{ $faqs->links() }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div
                                class="cta bg--3 d-flex justify-content-center align-items-center flex-wrap ptb--70 ptb-sm--50">
                                <h2 class="heading-secondary color--white mr--30 mr-xs--5">If you have more questions
                                </h2>
                                <a href="{{ route('contact') }}" class="btn btn-medium-size btn-style-4">Contact us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Wrapper Start -->

@endsection

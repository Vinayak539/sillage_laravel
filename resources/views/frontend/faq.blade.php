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
                                    <div class="col-lg-6">
                                        <div class="accordion__single mb--60 mb-lg--75 mb-md--55 mb-sm--40">
                                            <div class="accordion__header" id="headingOne">
                                                <a class="accordion__link" data-target="#accordionOne">
                                                    Quisque ut nulla viverra, posuere lorem ?
                                                </a>
                                            </div>
                                            <div id="accordionOne" class="accordion__body">
                                                <div class="accordion__text">
                                                    Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum
                                                    sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales
                                                    dolor nec mattis convallis.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion__single mb--60  mb-lg--75 mb-md--55 mb-sm--40">
                                            <div class="accordion__header" id="headingTwo">
                                                <a class="accordion__link" data-target="#accordionTwo">
                                                    Quisque ut nulla viverra, posuere lorem ?
                                                </a>
                                            </div>
                                            <div id="accordionTwo" class="accordion__body">
                                                <div class="accordion__text">
                                                    Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum
                                                    sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales
                                                    dolor nec mattis convallis.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion__single mb--60  mb-lg--75 mb-md--55 mb-sm--40">
                                            <div class="accordion__header" id="headingThree">
                                                <a class="accordion__link" data-target="#accordionThree">
                                                    Quisque ut nulla viverra, posuere lorem ?
                                                </a>
                                            </div>
                                            <div id="accordionThree" class="accordion__body">
                                                <div class="accordion__text">
                                                    Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum
                                                    sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales
                                                    dolor nec mattis convallis.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="accordion__single mb--60  mb-lg--75 mb-md--55 mb-sm--40">
                                            <div class="accordion__header" id="headingFive">
                                                <a class="accordion__link" data-target="#accordionFour">
                                                    Quisque ut nulla viverra, posuere lorem ?
                                                </a>
                                            </div>
                                            <div id="accordionFour" class="accordion__body">
                                                <div class="accordion__text">
                                                    Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum
                                                    sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales
                                                    dolor nec mattis convallis.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion__single mb--60  mb-lg--75 mb-md--55 mb-sm--40">
                                            <div class="accordion__header" id="headingSix">
                                                <a class="accordion__link" data-target="#accordionFive">
                                                    Quisque ut nulla viverra, posuere lorem ?
                                                </a>
                                            </div>
                                            <div id="accordionFive" class="accordion__body">
                                                <div class="accordion__text">
                                                    Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum
                                                    sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales
                                                    dolor nec mattis convallis.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion__single mb--60  mb-lg--75 mb-md--55 mb-sm--40">
                                            <div class="accordion__header" id="headingSeven">
                                                <a class="accordion__link" data-target="#accordionSix">
                                                    Quisque ut nulla viverra, posuere lorem ?
                                                </a>
                                            </div>
                                            <div id="accordionSix" class="accordion__body">
                                                <div class="accordion__text">
                                                    Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum
                                                    sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales
                                                    dolor nec mattis convallis.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

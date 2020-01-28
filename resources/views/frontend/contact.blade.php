@extends('layouts.master')
@section('title', 'Contact')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Contact Us</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Contact Us</span></li>
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
            <div class="row pt--75 pt-md--50 pt-sm--30 pb--80 pb-md--60 pb-sm--35">
                <div class="col-md-12">
                    @if(Session::has('messageSuccess'))
                        <div class="alert alert-success alert-dismissible mb-0">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{Session::get('messageSuccess')}}
                        </div>
                    @endif @if(Session::has('messageDanger'))
                        <div class="alert alert-danger alert-dismissible mb-0">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{Session::get('messageDanger')}}
                        </div>
                    @endif @if($errors->any())
                        <div class="alert alert-danger alert-dismissible mb-0">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-7 mb-sm--30">
                    <h2 class="heading-secondary mb--50 mb-md--35 mb-sm--20">Get in touch</h2>

                    <!-- Contact form Start Here -->
                    <form action="#"
                        class="form"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form__group mb--20">
                                <input type="text" placeholder="Name *"  class="form__input form__input--2" name="name" required="required"
                                value="{{old('name')}}" oninvalid="this.setCustomValidity('Please enter name')"
                                oninput="setCustomValidity('')">
                            </div>
                            <div class="col-md-6 form__group mb--20">
                                <input type="text" placeholder="E-mail *" class="form__input form__input--2" name="email" required="required"
                                        value="{{old('email')}}" oninvalid="this.setCustomValidity('Please enter email')"
                                        oninput="setCustomValidity('')">
                            </div>
                            <div class="col-md-6 form__group mb--20">
                                <input type="text" placeholder="Phone" class="form__input form__input--2" name="mobile" required="required"
                                        value="{{old('mobile')}}" oninvalid="this.setCustomValidity('Please enter mobile')"
                                        oninput="setCustomValidity('')">
                            </div>
                            <div class="col-md-6 form__group mb--20">
                                <input type="text" placeholder="Subject"  class="form__input form__input--2" name="subject" value="{{old('subject')}}">
                            </div>
                            <div class="col-md-12 form__group mb--20">
                                <textarea placeholder="Type Your Message" name="message"
                                class="form__input form__input--textarea">{{old('message')}}</textarea>
                            </div>
                            <div class="col-md-12 form__group">
                                <Button type="submit" class="btn btn-submit btn-style-1 update_button">Send</Button>
                            </div>
                        </div>
                    </form>
                    <!-- Contact form end Here -->

                </div>
                <div class="col-md-5 col-xl-4 offset-xl-1">
                    <h2 class="heading-secondary mb--50 mb-md--35 mb-sm--20">Contact info</h2>

                    <!-- Contact info widget start here -->
                    <div class="contact-info-widget mb--45 mb-sm--35">
                        <div class="contact-info">
                            <h3>Our Location</h3>
                            <p>Unit no.112, 1st Floor, Bldg no.A6,<br />
                                Harihar Complex, Dapode,Thane- 421302.</p>
                        </div>
                    </div>
                    <!-- Contact info widget end here -->

                    <!-- Contact info widget start here -->
                    <div class="contact-info-widget two-column-list sm-one-column mb--45 mb-sm--35">
                        <div class="contact-info mb-sm--35">
                            <h3>Customer Support No.</h3>
                            <a href="tel:+919619614785">(+91) 961 9614 785</a>
                        </div>
                        <div class="contact-info">
                            <h3>Email Id</h3>
                            <a href="mailto:contact@hnilifestyle.com">contact@hnilifestyle.com</a>
                        </div>
                    </div>
                    <!-- Contact info widget end here -->
                    <!-- Social Icons Start Here -->
                    <ul class="social body-color">
                        <li class="social__item">
                            <a href="https://www.facebook.com/hnilifestyle" target="_blank" class="social__link">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li class="social__item">
                            <a href="https://www.instagram.com/hni.lifestyle/" target="_blank" class="social__link">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                    </ul>
                    <!-- Social Icons End Here -->
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Main Content Wrapper Start -->

</div>
</div>
<!-- Main Content Wrapper Start -->

@endsection
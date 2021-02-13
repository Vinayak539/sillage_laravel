@extends('layouts_new.master')

@section('content')



  <!-- Whatsapp Sticky icon -->
  <div id="whatsapp">
    <a href="https://wa.me?+918999786866" target="_blank"><img src="{{ asset('assets/img/whatsapp1.svg') }}"></a>
  </div>

  
  <!-- main slider start -->
  <section class="bg-light">
    <div class="main-slider dots-style theme1 ">
      <video style="width: 100%;" autoplay>
        <source src="{{asset('assets/img/videos/v1.mp4')}}" type="video/mp4">
      </video>
      <video style="width: 100%;" autoplay>
        <source src="{{asset('assets/img/videos/v2.mp4')}}" type="video/mp4">
      </video>
      <video style="width: 100%;" autoplay>
        <source src="{{asset('assets/img/videos/v3.mp4')}}" type="video/mp4">
      </video>
      <!--<div class="slider-item bg-img bg-img1">-->


      <!--<div class="container">-->

      <!--  <div class="row align-items-center slider-height">-->

      <!--    <div class="col-12">-->

      <!--      <div class="slider-content">-->

      <!--<p-->
      <!--  class="text animated"-->
      <!--  data-animation-in="fadeInDown"-->
      <!--  data-delay-in=".300">-->

      <!--  Face Makeup Brush-->
      <!--</p>-->
      <!--<h2 class="title animated">-->
      <!--  <span-->
      <!--    class="animated d-block"-->
      <!--    data-animation-in="fadeInLeft"-->
      <!--    data-delay-in=".800"-->
      <!--    >Skincare Brush Set</span-->
      <!--  >-->
      <!--  <span-->
      <!--    class="animated font-weight-bold"-->
      <!--    data-animation-in="fadeInRight"-->
      <!--    data-delay-in="1.5"-->
      <!--    >Sale 30% Off</span-->
      <!--  >-->
      <!--</h2>-->
      <!--<a-->
      <!--  href="shop-grid-4-column.html"-->
      <!--  class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"-->
      <!--  data-animation-in="fadeInLeft">-->
      <!--  data-delay-in="1.9"-->
      <!--  Shop now</a>-->

      <!--        </div>-->
      <!--      </div>-->
      <!--    </div>-->
      <!--  </div>-->
    </div>
    <!-- slider-item end -->

    <!--<div class="slider-item bg-img bg-img2">-->
    <!--  <div class="container">-->
    <!--    <div class="row align-items-center slider-height">-->
    <!--      <div class="col-12">-->
    <!--        <div class="slider-content">-->


    <!--  <p-->
    <!--    class="text animated"-->
    <!--    data-animation-in="fadeInLeft"-->
    <!--    data-delay-in=".300"-->
    <!--  >-->
    <!--    Morneva Shampoo-->
    <!--  </p>-->

    <!--  <h2 class="title">-->
    <!--    <span-->
    <!--      class="animated d-block"-->
    <!--      data-animation-in="fadeInRight"-->
    <!--      data-delay-in=".800"-->
    <!--      >scalpcare Shampoo</span-->
    <!--    >-->
    <!--    <span-->
    <!--      class="animated font-weight-bold"-->
    <!--      data-animation-in="fadeInUp"-->
    <!--      data-delay-in="1.5"-->
    <!--      >Sale 40% Off</span-->
    <!--    >-->
    <!--  </h2>-->
    <!--  <a-->
    <!--    href="shop-grid-4-column.html"-->
    <!--    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"-->
    <!--    data-animation-in="fadeInLeft"-->
    <!--    data-delay-in="1.9"-->
    <!--    >Shop now</a>-->

    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->

    </div>
  </section>
  <!-- main slider end -->

  <section id="sec1" class="whatweoffer">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-md-12"  >
          <h2 class="title pt-3" style="text-align: center;font-size: 40px;">What We Offer</h2>
        </div>
        <div class="col-lg-4 col-md-4 wwf1" >
         <img class="img" src="{{asset('assets/img/per5.jpg')}}">
         <a href="{{route('user.login')}}" class="btn btn-lg btn-warning wwf">Login</a>
        </div>
        <div class="col-lg-4 col-md-4 wwf1">
         <img class="img" src="{{asset('assets/img/per6.jpg')}}">
         <a href="{{route('user.login')}}" class="btn btn-lg btn-warning wwf">Login</a>
        </div>
        <div class="col-lg-4 col-md-4 wwf1">
         <img class="img" src="{{asset('assets/img/per5.jpg')}}">
         <a href="{{route('user.login')}}" class="btn btn-lg btn-warning wwf">Login</a>
        </div>
      </div>
    </div>
  </section>

  <section id="sec2" class="whatweoffer trending bg-grey pb-4">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-log-12">
          <h3 class="content-title mt-4">Trending</h3>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 content-item ">
          <img class="img" src="{{asset('assets/img/mens.png')}}">
          <a href="designer(men).html" class="btn btn-lg btn-warning tren">Shop Now</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6  content-item">
          <img class="img" src="{{asset('assets/img/womens.png')}}">
          <a href="designer(men).html" class="btn btn-lg btn-warning tren">Shop Now</a>
        </div>
      </div>
    </div>
  </section>

  <section id="sec3" class="whatweoffer mb-4">
    <!-- Carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2000" data-wrap="true">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{asset('assets/img/perfume2.png')}}" alt="First slide">
          <div class="caption">
            <a href="" class="btn btn-lg btn-dark">Shop Now</a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{asset('assets/img/perfume2.png')}}" alt="Second slide">
          <div class="caption">
            <a href="" class="btn btn-lg btn-dark">Shop Now</a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{asset('assets/img/perfume2.png')}}" alt="Third slide">
          <div class="caption">
            <a href="" class="btn btn-lg btn-dark">Shop Now</a>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </section>

  <section id="sec4" class="whatweoffer specail-product mb-4">
    <div class="container-fluid">
      <div class="row g-0">
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="box">
            <img src="{{asset('assets/img/per12_.png')}}">
            <h3>Arabian Perfumes</h3>
            <a href="" class="btn btn-lg btn-dark"> Shop Now</a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="box">
            <img src="{{asset('assets/img/per11_.png')}}">
            <h3>French Perfumes</h3>
            <a href="" class="btn btn-lg btn-dark"> Shop Now</a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="box">
            <img src="{{asset('assets/img/per13_.png')}}">
            <h3>Iranian Perfumes</h3>
            <a href="" class="btn btn-lg btn-dark"> Shop Now</a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="box">
            <img src="{{asset('assets/img/per11_.png')}}">
            <h3>Western Perfumes</h3>
            <a href="" class="btn btn-lg btn-dark"> Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="sec5" class="whatweoffer mb-4">
    
          <video style="width: 100%;" autoplay controls loop>
            <source src="{{asset('assets/img/videos/v3.mp4')}}" type="video/mp4">
          </video>
          <div class="text-center">
            <a href="" class="btn btn-lg btn-dark cbtn">View All Videos</a>
          </div>
        
  </section>

<hr>
  <!-- product tab repetation start -->
  <section class="bg-white theme1 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- section-title start -->
          <div class="section-title text-center">
            <h2 class="title pb-3 ">New Arrival products</h2>
            <p class="text mb-3">
             The newest & hottest collection is out here. Get it now ! 
            </p>
          </div>
          <!-- section-title end -->
          <div class="product-slider-init theme1 slick-nav">
            <div class="slider-item">
              <div class="card product-card">
                <div class="card-body p-0">
                  <div class="media flex-column">
                    <div class="product-thumbnail position-relative">
                      <span class="badge badge-danger top-right">New</span>
                      <a href="single-product.html">
                        <img class="first-img" src="{{asset('assets/img/p1.jpg')}}" alt="thumbnail" />
                      </a>
                      <!-- product links -->
                      <ul class="actions d-flex justify-content-center">
                        <li>
                          <a class="action" href="wishlist.html">
                            <span data-toggle="tooltip" data-placement="bottom" title="add to wishlist"
                              class="icon-heart">
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#compare">
                            <span data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                              class="icon-shuffle"></span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#quick-view">
                            <span data-toggle="tooltip" data-placement="bottom" title="Quick view"
                              class="icon-magnifier"></span>
                          </a>
                        </li>
                      </ul>
                      <!-- product links end-->
                    </div>
                    <div class="media-body">
                      <div class="product-desc">
                        <h3 class="title">
                          <a href="single-product.html">All Natural Makeup Beauty Cosmetics</a>
                        </h3>
                        <div class="star-rating">
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star de-selected"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="product-price">$11.90</span>
                          <button class="pro-btn" data-toggle="modal" data-target="#add-to-cart">
                            <i class="icon-basket"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="card product-card">
                <div class="card-body p-0">
                  <div class="media flex-column">
                    <div class="product-thumbnail position-relative">
                      <span class="badge badge-danger top-right">New</span>
                      <a href="single-product.html">
                        <img class="first-img" src="{{asset('assets/img/p1.jpg')}}" alt="thumbnail" />
                      </a>
                      <!-- product links -->
                      <ul class="actions d-flex justify-content-center">
                        <li>
                          <a class="action" href="wishlist.html">
                            <span data-toggle="tooltip" data-placement="bottom" title="add to wishlist"
                              class="icon-heart">
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#compare">
                            <span data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                              class="icon-shuffle"></span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#quick-view">
                            <span data-toggle="tooltip" data-placement="bottom" title="Quick view"
                              class="icon-magnifier"></span>
                          </a>
                        </li>
                      </ul>
                      <!-- product links end-->
                    </div>
                    <div class="media-body">
                      <div class="product-desc">
                        <h3 class="title">
                          <a href="single-product.html">On Trend Makeup and Beauty Cosmetics</a>
                        </h3>
                        <div class="star-rating">
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star de-selected"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="product-price">$11.90</span>
                          <button class="pro-btn" data-toggle="modal" data-target="#add-to-cart">
                            <i class="icon-basket"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="card product-card">
                <div class="card-body p-0">
                  <div class="media flex-column">
                    <div class="product-thumbnail position-relative">
                      <span class="badge badge-danger top-right">New</span>
                      <a href="single-product.html">
                        <img class="first-img" src="{{asset('assets/img/p5.jpg')}}" alt="thumbnail" />
                      </a>
                      <!-- product links -->
                      <ul class="actions d-flex justify-content-center">
                        <li>
                          <a class="action" href="wishlist.html">
                            <span data-toggle="tooltip" data-placement="bottom" title="add to wishlist"
                              class="icon-heart">
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#compare">
                            <span data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                              class="icon-shuffle"></span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#quick-view">
                            <span data-toggle="tooltip" data-placement="bottom" title="Quick view"
                              class="icon-magnifier"></span>
                          </a>
                        </li>
                      </ul>
                      <!-- product links end-->
                    </div>
                    <div class="media-body">
                      <div class="product-desc">
                        <h3 class="title">
                          <a href="single-product.html">The Cosmetics and Beauty brand Shoppe</a>
                        </h3>
                        <div class="star-rating">
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star de-selected"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="product-price">$21.51</span>
                          <button class="pro-btn" data-toggle="modal" data-target="#add-to-cart">
                            <i class="icon-basket"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="card product-card">
                <div class="card-body p-0">
                  <div class="media flex-column">
                    <div class="product-thumbnail position-relative">
                      <span class="badge badge-danger top-right">New</span>
                      <a href="single-product.html">
                        <img class="first-img" src="assets/img/p2.jpg" alt="thumbnail" />
                      </a>
                      <!-- product links -->
                      <ul class="actions d-flex justify-content-center">
                        <li>
                          <a class="action" href="wishlist.html">
                            <span data-toggle="tooltip" data-placement="bottom" title="add to wishlist"
                              class="icon-heart">
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#compare">
                            <span data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                              class="icon-shuffle"></span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#quick-view">
                            <span data-toggle="tooltip" data-placement="bottom" title="Quick view"
                              class="icon-magnifier"></span>
                          </a>
                        </li>
                      </ul>
                      <!-- product links end-->
                    </div>
                    <div class="media-body">
                      <div class="product-desc">
                        <h3 class="title">
                          <a href="single-product.html">orginal Age Defying Cosmetics Makeup</a>
                        </h3>
                        <div class="star-rating">
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star de-selected"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="product-price">$11.90</span>
                          <button class="pro-btn" data-toggle="modal" data-target="#add-to-cart">
                            <i class="icon-basket"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="card product-card">
                <div class="card-body p-0">
                  <div class="media flex-column">
                    <div class="product-thumbnail position-relative">
                      <span class="badge badge-danger top-right">New</span>
                      <a href="single-product.html">
                        <img class="first-img" src="{{asset('assets/img/p3.jpg')}}" alt="thumbnail" />
                        <img class="second-img" src="{{asset('assets/img/p4.jpg')}}" alt="thumbnail" />
                      </a>
                      <!-- product links -->
                      <ul class="actions d-flex justify-content-center">
                        <li>
                          <a class="action" href="wishlist.html">
                            <span data-toggle="tooltip" data-placement="bottom" title="add to wishlist"
                              class="icon-heart">
                            </span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#compare">
                            <span data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                              class="icon-shuffle"></span>
                          </a>
                        </li>
                        <li>
                          <a class="action" href="#" data-toggle="modal" data-target="#quick-view">
                            <span data-toggle="tooltip" data-placement="bottom" title="Quick view"
                              class="icon-magnifier"></span>
                          </a>
                        </li>
                      </ul>
                      <!-- product links end-->
                    </div>
                    <div class="media-body">
                      <div class="product-desc">
                        <h3 class="title">
                          <a href="single-product.html">orginal Clear Water Cosmetics On Trend</a>
                        </h3>
                        <div class="star-rating">
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star"></span>
                          <span class="ion-ios-star de-selected"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <span class="product-price">$11.90</span>
                          <button class="pro-btn" data-toggle="modal" data-target="#add-to-cart">
                            <i class="icon-basket"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <!-- New women's Fresh Faced Trendy cream -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product tab repetation end -->
















  <!-- brands-section start -->
  <section class="blog-section theme1 pb-65" style="padding:30px auto 30px auto;background-color: black;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h2 class="title pb-3 mb-3" style="color:#ffc60b;margin-top: 30px;">Brands</h2>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="blog-init1 slick-nav">
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand9.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand1.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand2.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand3.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand4.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand5.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand6.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand7.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/brand1/brand8.png')}}" alt="blog-thumb-naile" />


              </div>
            </div>
          </div>
          <!-- slider-item end -->
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- blog-section end -->











  <!-- blog-section start -->
  <section class="blog-section theme1 pb-65 view-all" style="padding:30px auto;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h2 class=" pb-3 " style="margin-top: 30px;">Customer Testimonials</h2>
            <p class="text mb-3">
              Some of our Customer Reviews
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="blog-init slick-nav">
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/blog-post/1.png')}}" alt="blog-thumb-naile" />

                <div class="blog-post-content">
                  I was using vanilla scented body spray for work as I shouldn’t really use perfume in my
                  profession. I
                  decided to buy this eau the toilette as I assumed it would be safe and light.
                  <h3 class="title mb-15">
                    Karthik Bhatt
                  </h3>

                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/blog-post/1.png')}}" alt="blog-thumb-naile" />

                <div class="blog-post-content">
                  I was using vanilla scented body spray for work as I shouldn’t really use perfume in my
                  profession. I
                  decided to buy this eau the toilette as I assumed it would be safe and light.
                  <h3 class="title mb-15">
                    Karthik Bhatt
                  </h3>

                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/blog-post/1.png')}}" alt="blog-thumb-naile" />

                <div class="blog-post-content">
                  I was using vanilla scented body spray for work as I shouldn’t really use perfume in my
                  profession. I
                  decided to buy this eau the toilette as I assumed it would be safe and light.
                  <h3 class="title mb-15">
                    Krishna G
                  </h3>

                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/blog-post/1.png')}}" alt="blog-thumb-naile" />

                <div class="blog-post-content">
                  I was using vanilla scented body spray for work as I shouldn’t really use perfume in my
                  profession. I
                  decided to buy this eau the toilette as I assumed it would be safe and light.
                  <h3 class="title mb-15">
                    Karan Singh
                  </h3>

                </div>
              </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item">
              <div class="single-blog">

                <img src="{{asset('assets/img/blog-post/1.png')}}" alt="blog-thumb-naile" />

                <div class="blog-post-content">
                  I was using vanilla scented body spray for work as I shouldn’t really use perfume in my
                  profession. I
                  decided to buy this eau the toilette as I assumed it would be safe and light. I was using vanilla
                  scented body spray for work as I shouldn’t really use perfume in my profession.
                  <h3 class="title mb-15">
                    Keerthi Mishra
                  </h3>

                </div>
              </div>
            </div>
            <!-- slider-item end -->


          </div>
          <a href="/testimonials" class="btn btn-block btn-dark cbtn">View All</a>
        </div>
      </div>
    </div>
  </section>
  <!-- blog-section end -->







  <!-- staic media start -->
  <section class="static-media-section  bg-white">
    <div class="container-fluid px-0">
      <div class="static-media-wrap theme-bg" style="background-color:black;">
        <div class="row">
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3" src="{{asset('assets/img/icon/2.png')}}" alt="icon" />
              <div class="media-body">
                <h4 class="title" style="color:gold;"> Shipping</h4>
                <p class="text"> Shipping all over India</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3" src="{{asset('assets/img/icon/3.png')}}" alt="icon" />
              <div class="media-body">
                <h4 class="title" style="color:gold;"> Returns</h4>
                <p class="text">Returns accepted within 14 days</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3" src="{{asset('assets/img/icon/4.png')}}" alt="icon" />
              <div class="media-body">
                <a data-toggle="modal" data-target="#exampleModalCenter1">
                  <h4 class="title" style="color:gold;text-decoration: underline;">100% Secure Payment</h4>
                </a>
                <p class="text">Your payment are safe with us.</p>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">100% Secure Payment </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <img src="{{asset('assets/img/payment-safe.png')}}">
                      </div>
                      <div class="modal-footer">

                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                  </div>
                </div>





              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3" src="{{asset('assets/img/icon/5.png')}}" alt="icon" />
              <div class="media-body">
                <a data-toggle="modal" data-target="#exampleModalCenter2">
                  <h4 class="title" style="color:gold;text-decoration: underline;">Support 24/7</h4>
                </a>
                <p class="text">Contact us 24 hours a day</p>


                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Support 24/7</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Mail us at <a href="mailto:connect@sillageniche.com"
                          style="color:blue;text-decoration: underline;">connect@sillageniche.com</a>
                      </div>
                      <div class="modal-footer">

                        <a type="button" href="mailto:connect@sillageniche.com" class="btn btn-primary">Email</a>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- staic media end -->







@endsection
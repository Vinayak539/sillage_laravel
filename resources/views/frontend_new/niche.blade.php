@extends('layouts_new.master')

@section('content')


<!-- Slideshow -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('assets/img/nb/n1.jpg')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('assets/img/nb/n2.jpg')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('assets/img/nb/n3.jpg')}}" alt="Third slide">
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



<!-- product tab start -->
<div class="product-tab bg-white pt-20 pb-20">
  <div class="container">
    <div class="grid-nav-wraper bg-lighten2 mb-30">
      <div class="row align-items-center">
        {{-- <div class="col-12 col-md-6 mb-3 mb-md-0">
          <nav class="shop-grid-nav">
            <ul
              class="nav nav-pills align-items-center"
              id="pills-tab"
              role="tablist"
            >
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="pills-home-tab"
                  data-toggle="pill"
                  href="#pills-home"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                >
                  <i class="fa fa-th"></i>
                </a>
              </li>
              <li class="nav-item mr-0">
                <a
                  class="nav-link"
                  id="pills-profile-tab"
                  data-toggle="pill"
                  href="#pills-profile"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                  ><i class="fa fa-list"></i
                ></a>
              </li>
              <li>
                <span class="total-products text-capitalize"
                  >There are 13 products.</span
                >
              </li>
            </ul>
          </nav>
        </div> --}}
        <div class="col-12 col-md-6 position-relative">
          <div class="shop-grid-button d-flex align-items-center">
            <span class="sort-by">Products By Brands:</span>
            <select
              class="form-select custom-select"
              aria-label="Default select example"
            >
              <option selected>Any</option>
              <option value="1">Gucci</option>
              <option value="2">Chanel</option>
              <option value="3">Armani</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <!-- product-tab-nav end -->
    <div class="tab-content" id="pills-tabContent">
      <!-- first tab-pane -->
      <div
        class="tab-pane fade show active"
        id="pills-home"
        role="tabpanel"
        aria-labelledby="pills-home-tab"
      >
        <div class="row grid-view theme1">
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">New</span>
                  <a href="single-product.html">
                    <img
                      class="first-img"
                      src="{{asset('assets/img/p2.jpg')}}"
                      alt="thumbnail"
                    />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >All Natural Makeup Beauty Cosmetics</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-success top-left">-10%</span>
                  <span class="badge badge-danger top-right">hot</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p5.jpg')}}"
                    alt="thumbnail"
                  />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >On Trend Makeup and Beauty Cosmetics</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                  <span class="product-price">$11.90</span>
                  <button
                    class="pro-btn"
                    data-toggle="modal"
                    data-target="#add-to-cart"
                  >
                    <i class="icon-basket"></i>
                  </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">featured</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p5.jpg')}}"
                    alt="thumbnail"
                  />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >The Cosmetics and Beauty brand Shoppe</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">sale</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p2.jpg')}}"
                    alt="thumbnail"
                  />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >orginal Clear Water Cosmetics On Trend</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">New</span>
                  <a href="single-product.html">
                    <img
                      class="first-img"
                      src="{{asset('assets/img/p3.jpg')}}"
                      alt="thumbnail"
                    />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >All Natural Makeup Beauty Cosmetics</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <h6 class="product-price">$21.51</h6>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">sale</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p1.jpg')}}"
                    alt="thumbnail"
                  />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >orginal Kaval Windbreaker Winter cream</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">featured</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p5.jpg')}}"
                    alt="thumbnail"
                  />
                    {{-- <img
                      class="second-img"
                      src="assets/img/product/12.png"
                      alt="thumbnail"
                    /> --}}
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >All Natural Makeup Beauty Cosmetics</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                  <span class="product-price">$11.90</span>
                  <button
                    class="pro-btn"
                    data-toggle="modal"
                    data-target="#add-to-cart"
                  >
                    <i class="icon-basket"></i>
                  </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">New</span>
                  <a href="single-product.html">
                    <img
                      class="first-img"
                      src="{{asset('assets/img/p2.jpg')}}"
                      alt="thumbnail"
                    />
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >orginal Kaval Windbreaker Winter cream</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">featured</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p3.jpg')}}"
                    alt="thumbnail"
                  />
                    {{-- <img
                      class="second-img"
                      src="assets/img/product/12.png"
                      alt="thumbnail"
                    /> --}}
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >All Natural Makeup Beauty Cosmetics...</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">sale</span>
                  <a href="single-product.html">
                    <img
                    class="first-img"
                    src="{{asset('assets/img/p2.jpg')}}"
                    alt="thumbnail"
                  />
                    {{-- <img
                      class="second-img"
                      src="assets/img/product/5.png"
                      alt="thumbnail"
                    /> --}}
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >orginal Kaval Windbreaker Winter cream</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">New</span>
                  <a href="single-product.html">
                    <img
                      class="first-img"
                      src="{{asset('assets/img/p2.jpg')}}"
                      alt="thumbnail"
                    />
                    {{-- <img
                      class="second-img"
                      src="assets/img/product/8.png"
                      alt="thumbnail"
                    /> --}}
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >All Natural Makeup Beauty Cosmetics...</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                  <span class="product-price">$11.90</span>
                  <button
                    class="pro-btn"
                    data-toggle="modal"
                    data-target="#add-to-cart"
                  >
                    <i class="icon-basket"></i>
                  </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-sm-4  col-lg-4 col-6 col-xl-3 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="product-thumbnail position-relative">
                  <span class="badge badge-danger top-right">featured</span>
                  <a href="single-product.html">
                    <img
                      class="first-img"
                      src="{{asset('assets/img/p2.jpg')}}"
                      alt="thumbnail"
                    />
                    {{-- <img
                      class="second-img"
                      src="assets/img/product/5.png"
                      alt="thumbnail"
                    /> --}}
                  </a>
                  <!-- product links -->
                  <ul class="actions d-flex justify-content-center">
                    <li>
                      <a class="action" href="wishlist.html">
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="add to wishlist"
                          class="icon-heart"
                        >
                        </span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#compare"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Add to compare"
                          class="icon-shuffle"
                        ></span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="action"
                        href="#"
                        data-toggle="modal"
                        data-target="#quick-view"
                      >
                        <span
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Quick view"
                          class="icon-magnifier"
                        ></span>
                      </a>
                    </li>
                  </ul>
                  <!-- product links end-->
                </div>
                <div class="product-desc py-0 px-0">
                  <h3 class="title">
                    <a href="shop-grid-4-column.html"
                      >orginal Kaval Windbreaker Winter cream</a
                    >
                  </h3>
                  <div class="star-rating">
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star de-selected"></span>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between"
                  >
                    <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
        </div>
      </div>
      <!-- second tab-pane -->
      <div
        class="tab-pane fade"
        id="pills-profile"
        role="tabpanel"
        aria-labelledby="pills-profile-tab"
      >
        <div class="row grid-view-list theme1">
          <div class="col-12 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="media flex-column flex-md-row">
                  <div class="product-thumbnail position-relative">
                    <span class="badge badge-danger top-right">sale</span>
                    <a href="single-product.html">
                      <img
                        class="first-img"
                        src="assets/img/product/1.png"
                        alt="thumbnail"
                      />
                    </a>
                    <!-- product links -->
                    <ul class="actions d-flex justify-content-center">
                      <li>
                        <a class="action" href="wishlist.html">
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="add to wishlist"
                            class="icon-heart"
                          >
                          </span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#compare"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Add to compare"
                            class="icon-shuffle"
                          ></span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#quick-view"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Quick view"
                            class="icon-magnifier"
                          ></span>
                        </a>
                      </li>
                    </ul>
                    <!-- product links end-->
                  </div>
                  <div class="media-body pl-md-4">
                    <div class="product-desc py-0 px-0">
                      <h3 class="title">
                        <a href="shop-grid-4-column.html"
                          >All Natural Makeup Beauty Cosmetics...</a
                        >
                      </h3>
                      <div class="star-rating mb-10">
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star de-selected"></span>
                      </div>
                      <span class="product-price">$11.90</span>
                    </div>
                    <ul class="product-list-des">
                      <li>
                        Block out the haters with the fresh adidas® Originals
                        Kaval Windbreaker Face Cream.
                      </li>
                      <li>Part of the Kaval Collection.</li>
                      <li>
                        Regular fit is eased, but not sloppy, and perfect for
                        any activity.
                      </li>
                      <li>
                        Plain-woven Face Cream specifically constructed for
                        freedom of movement.
                      </li>
                    </ul>
                    <div class="availability-list mb-20">
                      <p>Availability: <span>1200 In Stock</span></p>
                    </div>
                    <button
                      class="btn btn-dark btn--xl"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      Add to cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-12 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="media flex-column flex-md-row">
                  <div class="product-thumbnail position-relative">
                    <span class="badge badge-success top-left">-10%</span>
                    <span class="badge badge-danger top-right">New</span>
                    <a href="single-product.html">
                      <img
                        class="first-img"
                        src="assets/img/product/6.png"
                        alt="thumbnail"
                      />
                    </a>
                    <!-- product links -->
                    <ul class="actions d-flex justify-content-center">
                      <li>
                        <a class="action" href="wishlist.html">
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="add to wishlist"
                            class="icon-heart"
                          >
                          </span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#compare"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Add to compare"
                            class="icon-shuffle"
                          ></span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#quick-view"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Quick view"
                            class="icon-magnifier"
                          ></span>
                        </a>
                      </li>
                    </ul>
                    <!-- product links end-->
                  </div>
                  <div class="media-body pl-md-4">
                    <div class="product-desc py-0 px-0">
                      <h3 class="title">
                        <a href="shop-grid-4-column.html"
                          >On Trend Makeup and Beauty Cosmetics...</a
                        >
                      </h3>
                      <div class="star-rating mb-10">
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star de-selected"></span>
                      </div>
                      <span class="product-price">$11.90</span>
                    <button
                      class="pro-btn"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      <i class="icon-basket"></i>
                    </button>
                    </div>

                    <ul class="product-list-des">
                      <li>
                        Block out the haters with the fresh adidas® Originals
                        Kaval Windbreaker Face Cream.
                      </li>
                      <li>Part of the Kaval Collection.</li>
                      <li>
                        Regular fit is eased, but not sloppy, and perfect for
                        any activity.
                      </li>
                      <li>
                        Plain-woven Face Cream specifically constructed for
                        freedom of movement.
                      </li>
                    </ul>
                    <div class="availability-list mb-20">
                      <p>Availability: <span>1200 In Stock</span></p>
                    </div>
                    <button
                      class="btn btn-dark btn--xl"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      Add to cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-12 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="media flex-column flex-md-row">
                  <div class="product-thumbnail position-relative">
                    <span class="badge badge-danger top-right">onsale</span>
                    <a href="single-product.html">
                      <img
                        class="first-img"
                        src="assets/img/product/2.png"
                        alt="thumbnail"
                      />
                    </a>
                    <!-- product links -->
                    <ul class="actions d-flex justify-content-center">
                      <li>
                        <a class="action" href="wishlist.html">
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="add to wishlist"
                            class="icon-heart"
                          >
                          </span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#compare"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Add to compare"
                            class="icon-shuffle"
                          ></span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#quick-view"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Quick view"
                            class="icon-magnifier"
                          ></span>
                        </a>
                      </li>
                    </ul>
                    <!-- product links end-->
                  </div>
                  <div class="media-body pl-md-4">
                    <div class="product-desc py-0 px-0">
                      <h3 class="title">
                        <a href="shop-grid-4-column.html"
                          >New Balance Fresh Cream Kaymin from new zeland</a
                        >
                      </h3>
                      <div class="star-rating mb-10">
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star de-selected"></span>
                      </div>
                      <span class="product-price">$11.90</span>
                    </div>
                    <ul class="product-list-des">
                      <li>
                        Block out the haters with the fresh adidas® Originals
                        Kaval Windbreaker Face Cream.
                      </li>
                      <li>Part of the Kaval Collection.</li>
                      <li>
                        Regular fit is eased, but not sloppy, and perfect for
                        any activity.
                      </li>
                      <li>
                        Plain-woven Face Cream specifically constructed for
                        freedom of movement.
                      </li>
                    </ul>
                    <div class="availability-list mb-20">
                      <p>Availability: <span>1200 In Stock</span></p>
                    </div>
                    <button
                      class="btn btn-dark btn--xl"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      Add to cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- product-list End -->
          </div>
          <div class="col-12 mb-30">
            <div class="card product-card">
              <div class="card-body">
                <div class="media flex-column flex-md-row">
                  <div class="product-thumbnail position-relative">
                    <span class="badge badge-danger top-right">featured</span>
                    <a href="single-product.html">
                      <img
                        class="first-img"
                        src="assets/img/product/7.png"
                        alt="thumbnail"
                      />
                    </a>
                    <!-- product links -->
                    <ul class="actions d-flex justify-content-center">
                      <li>
                        <a class="action" href="wishlist.html">
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="add to wishlist"
                            class="icon-heart"
                          >
                          </span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#compare"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Add to compare"
                            class="icon-shuffle"
                          ></span>
                        </a>
                      </li>
                      <li>
                        <a
                          class="action"
                          href="#"
                          data-toggle="modal"
                          data-target="#quick-view"
                        >
                          <span
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Quick view"
                            class="icon-magnifier"
                          ></span>
                        </a>
                      </li>
                    </ul>
                    <!-- product links end-->
                  </div>
                  <div class="media-body pl-md-4">
                    <div class="product-desc py-0 px-0">
                      <h3 class="title">
                        <a href="shop-grid-4-column.html"
                          >orginal Kaval Windbreaker Winter cream</a
                        >
                      </h3>
                      <div class="star-rating mb-10">
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star"></span>
                        <span class="ion-ios-star de-selected"></span>
                      </div>
                      <span class="product-price">$11.90</span>
                    </div>
                    <ul class="product-list-des">
                      <li>
                        Block out the haters with the fresh adidas® Originals
                        Kaval Windbreaker Face Cream.
                      </li>
                      <li>Part of the Kaval Collection.</li>
                      <li>
                        Regular fit is eased, but not sloppy, and perfect for
                        any activity.
                      </li>
                      <li>
                        Plain-woven Face Cream specifically constructed for
                        freedom of movement.
                      </li>
                    </ul>
                    <div class="availability-list mb-20">
                      <p>Availability: <span>1200 In Stock</span></p>
                    </div>
                    <button
                      class="btn btn-dark btn--xl"
                      data-toggle="modal"
                      data-target="#add-to-cart"
                    >
                      Add to cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <nav class="pagination-section mt-30">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" href="#"><i class="ion-chevron-left"></i></a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item">
              <a class="page-link" href="#"
                ><i class="ion-chevron-right"></i
              ></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- product tab end -->


@endsection
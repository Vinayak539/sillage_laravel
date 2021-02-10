@extends('layouts_new.master')

@section('content')



<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110" style="background-image: url('{{asset('assets/img/images/abt-img.jpg')}}');">
    <div class="container">
      <div class="row ">
        <div class="col-12 ">
          <div class="section-title text-center ">
            <h2 class="title pb-4 text-dark text-capitalize">About Us</h2>
          </div>
        </div>
        <!-- <div class="col-12">
          <ol
            class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
          >
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
          </ol>
        </div> -->
      </div>
    </div>
  </nav>
  <!-- breadcrumb-section end -->
  <!-- product tab start -->
  <section class="about-section pt-80 pb-50">
    <div class="container">
      <div class="row">
        <div class="col-12 col-xl-11 mx-auto mb-30">
          <div class="about-content text-center">
            <<!-- div class="about-left-image mb-30">
              <img
                src="assets/img/blog-post/5.jpg"
                alt="img"
                class="img-responsive"
              />
            </div> -->
            <div>
              <h2 class="title mb-30">
                We are a Perfume & Cosmetic agency focused on delivering our best quality products for complete customer satisfaction.
              </h2>
              <p class="mb-30">
                Adipiscing lacus ut elementum, nec duis, tempor litora turpis
                dapibus. Imperdiet cursus odio tortor in elementum. Egestas nunc
                eleifend feugiat lectus laoreet, vel nunc taciti integer cras. Hac
                pede dis, praesent nibh ac dui mauris sit. Pellentesque mi,
                facilisi mauris, elit sociis leo sodales accumsan. Iaculis ac
                fringilla torquent lorem consectetuer, sociosqu phasellus risus
                urna aliquam, ornare.
              </p>
              <p class="mb-30">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
              <img src="{{asset('assets/img/blog-post/signature.png')}}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection


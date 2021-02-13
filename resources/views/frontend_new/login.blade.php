@extends('layouts_new.master')

@section('content')

<!-- login area start -->
<div class="login-register-area pt-30 pb-10">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-12 ml-auto mr-auto">
          <div class="login-register-wrapper">
            <div class="login-register-tab-list nav">
              
              <a class="active" data-toggle="tab" href="#lg1">
                <h4>login</h4>
              </a>
              <a data-toggle="tab" href="#lg2">
                <h4>register</h4>
              </a>
            </div>
            <div class="tab-content">
              <div id="lg1" class="tab-pane active">
                <div class="login-form-container">
                  <div class="login-register-form">
                    <form action="" method="post">
                      <input
                        type="text"
                        name="user-name"
                        placeholder="Username"
                      />
                      <input
                        type="password"
                        name="user-password"
                        placeholder="Password"
                      />
                      <div class="button-box">
                        <div class="login-toggle-btn">
                          <div style="float: left;">
                          <input id="remember" type="checkbox" />
                          <label for="remember" >Remember me</label>
                        </div>
                          <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-dark btn--md">
                          <span>Login</span>
                        </button>
                        </div>
                        <h4 style="text-align: center;">OR</h4>
  
                        <div class="social-login">
                          <a href="" class="btn btn-lg " style="background-color: #EA4335;"><span class="fab  fa-google fa-lg"></span> Google</a><br>
                          <a href="" class="btn btn-lg " style="background-color: #0084FF;"><span class="fab fa-facebook fa-lg"></span> Facebook</a>
                        </div>
  
                      
                    </form>
                  </div>
                </div>
              </div>
              <div id="lg2" class="tab-pane ">
                <div class="login-form-container">
                  <div class="login-register-form">
                    <form action="" method="post">
                      <input
                        type="text"
                        name="user-name"
                        placeholder="Username"
                      />
                      <input
                        type="password"
                        name="user-password"
                        placeholder="Password"
                      />
                      <input name="user-email" placeholder="Email" type="email" />
                       <input name="number" placeholder="Contact" type="tel" />
                       <textarea rows="5" class="textarea" placeholder="Address"></textarea>
                       <input name="linkedin" placeholder="LinkedIn/ Facebook/ Twitter Profile" type="text" />
                       
                       <div id="occupat">
                        <h3>Select your Occupation</h3>
  
                        <input type="radio" id="business" name="occupation" value="business" onclick="occChanged(event)"> 
                        <label for="business" >Business</label><br>
   
                        <input type="radio" id="salareid" name="occupation" value="salareid" onclick="occChanged(event)">
                        <label for="salareid" >Salareid </label><br>
                       </div>
                       
  
                       <div id="business1">
                        <input type="text" name="business_name" placeholder="Business Name">
  
                       </div> 
                       
                       <div id="salareid1">
                        <input type="text" name="company_name" placeholder="Company Name">
                        <input type="text" name="designation" placeholder="Designation"> 
                       </div>
  
  <script>
  function occChanged(event){                      
    var a = event.target.id;
    // alert(a);
    if (a =="salareid"){
      $('#business1').css("display","none");
     $('#salareid1').css("display","block");
    }else if (a =="business"){
      $('#salareid1').css("display","none");
      $('#business1').css("display","block");
    }
  }
  </script>
  
                      <div class="button-box">
                        <button type="submit" class="btn btn-dark btn--md">
                          <span>Register</span>
                        </button>
                      </div>
  
  
  
  
  
   <h4 style="text-align: center;">OR</h4>
  
                        <div class="social-login">
                          <a href="" class="btn btn-lg " style="background-color:#d34836;"><span class="fab  fa-google fa-lg"></span> Google</a><br>
                          <a href="" class="btn btn-lg " style="background-color: #0084FF;"><span class="fab fa-facebook fa-lg"></span> Facebook</a>
                        </div>
  
  
                    </form>
  
  
  
  <div class="social-network2 social-reg">
                <ul class="d-flex justify-content-center">
                  <li>
                    <a href="https://www.facebook.com/" target="_blank"
                      ><span class="icon-social-facebook"></span
                    ></a>
                  </li>
                  <li>
                    <a href="https://twitter.com/" target="_blank"
                      ><span class="icon-social-twitter"></span
                    ></a>
                  </li>
                  <li>
                    <a href="https://www.youtube.com/" target="_blank"
                      ><span class="icon-social-youtube"></span
                    ></a>
                  </li>
  
                  <li class="">
                    <a href="https://www.instagram.com/" target="_blank"
                      ><span class="icon-social-instagram"></span
                    ></a>
                  </li>
                   <li class="">
                    <a href="https://www.instagram.com/" target="_blank"
                      ><span class="icon-social-linkedin"></span
                    ></a>
                  </li>
                  
                </ul>
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
  <!-- login area end -->
  


@endsection
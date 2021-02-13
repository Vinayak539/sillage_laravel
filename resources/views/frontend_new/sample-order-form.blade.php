@extends('layouts_new.master')

@section('content')

<div class="login-register-area pt-10 pb-10" >
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-12 ml-auto mr-auto">
          <div class="login-register-wrapper">
            <div class="login-register-tab-list nav">

                <h4>Sample Order Form</h4>


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
           
           <textarea rows="5" name="address" class="textarea" placeholder="Address"></textarea>
           
           <textarea rows="5" name="comment" class="textarea" placeholder="Comments"></textarea>
           <input name="linkedin" placeholder="LinkedIn/ Facebook/ Twitter Profile" type="text" />

          <div class="button-box">
            <button type="submit" class="btn btn-dark btn--md">
              <span>Submit</span>
            </button>
          </div>
        </form>
      </div>
    </div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>

@endsection
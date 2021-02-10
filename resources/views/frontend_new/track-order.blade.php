@extends('layouts_new.master')

@section('content')



<section class="container">
 

    <div class="track row">
       <h1>Track Your Order</h1> 
       <div class="col-lg-6">
        <img src="{{asset('assets/img/track-order.jpg')}}">
       </div> 
  
      <div class="col-lg-6">
      <form method="post" action="">
        <input type="text" name="" placeholder="Enter Product ID">
         <input type="text" name="" placeholder="Enter Order Date">
        <button type="submit" name="" class="btn btn-lg btn-warning">Track</button>
      </form>
    </div>
    </div>
  
  </section>

@endsection


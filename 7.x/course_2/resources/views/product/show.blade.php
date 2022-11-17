@extends('product.layout')

@section('content')

<div class="container"   style="padding-top: 12%">
    <div class="card ">
        
        <div class="card-body">
          <p class="card-text "><h1 class="text-center">Product name : {{$product->name}}</h1></p>
        </div>
      </div>
</div>


<div class="container" style="padding-top: 2%">
     

        <div class="form-group">
          <label for="exampleFormControlInput1">  {{$product->name}}</label>
         
        </div>
     
        <div class="form-group">
            <label for="exampleFormControlInput1">  {{$product->price}}</label>
           
          </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">{{$product->detail}} </label>
         
        </div>

       



    
</div>





@endsection
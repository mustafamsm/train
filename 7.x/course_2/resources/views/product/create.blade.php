@extends('product.layout')

@section('content')

<div class="container"   style="padding-top: 12%">
    <div class="card ">
        
        <div class="card-body">
          <p class="card-text "><span><a class="btn btn-success"href="{{route('products.index')}}">back</a></span><h1 class="text-center">Add Prduct.</h1></p>
        </div>
      </div>
</div>


<div class="container" style="padding-top: 2%">
    
<form action="{{ route('products.store')}}" method="POST">
    @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">  Name</label>
          <input type="text" name="name" class="form-control"  placeholder="product name">
          @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
               @enderror
        </div>
     
        <div class="form-group">
            <label for="exampleFormControlInput1">  Price</label>
            <input type="text" name="price" class="form-control"  placeholder="product price">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
          </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Details  </label>
          <textarea class="form-control" name="detail"   rows="3"></textarea>
          @error('detail')
          <div class="alert alert-danger">{{ $message }}</div>
               @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>

        </div>



    </form>
</div>





@endsection
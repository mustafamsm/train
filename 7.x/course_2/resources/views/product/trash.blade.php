@extends('product.layout')



@section('content')
<div class="jumbotron container">

  <p>Trashed products</p>
  <a class="btn btn-primary btn-lg" href="{{ route('products.index')}}" role="button">home  </a>
  {{-- <a class="btn btn-primary btn-lg" href="{{ route('product.trash')}}" role="button">Trash  </a> --}}

</div>

<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col" colspan="3" >Actions </th>
          </tr>
        </thead>
        <tbody>
          @php
             $i = 0;
            @endphp
         
          @foreach ($products as $product )
          <tr>
              <td>{{++$i}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->price}}</td>
              <td>
                <a href="{{route('soft.back',$product->id)}}" class="btn btn-success">back</a>
                <a href="{{route('product.delete.from.database',$product->id)}}" class="btn btn-success">Delete</a>


              </td>
  
              </tr>
          @endforeach
           
          
        </tbody>
      </table>
      {!! $products->links() !!}
</div>
 
@endsection
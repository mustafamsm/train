@extends('product.layout')



@section('content')
<div class="jumbotron container">

  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="{{ route('products.create')}}" role="button">Create  </a>
  <a class="btn btn-primary btn-lg" href="{{ route('product.trash')}}" role="button">Trash  </a>

</div>
<div class="container">
  @if ($message = Session::get('success'))
  <div class="alert alert-primary" role="alert">
    {{$message}}
    </div>
  @endif

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
                <a href="{{route('products.edit',$product->id)}}" class="btn btn-success">Edit</a></td>
                <td> <a href="{{route('products.show',$product->id)}}" class="btn btn-success">Show</a></td>
                <td><form action="{{route('products.destroy',$product->id)}}" method="post">
                    @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

              </td>
              <td><a href="{{route('soft.delete',$product->id)}}" class="btn btn-success">softDelete</a></td>
              </tr>
          @endforeach
           
          
        </tbody>
      </table>
      {!! $products->links() !!}
</div>
 
@endsection
@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Posts</h1>
                <a href="{{route('posts.create')}}" class="btn btn-success" style="float: right">Create Post</a>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            
                            <th scope="col">Id</th>
                            <th scope="col">Tilte</th>
                            <th scope="col">Actions</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($posts as $item )
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                  <a href="{{route('posts.show',$item->id)}}" class="btn btn-success"  >Show Post</a>

                                </td>
                            </tr>
                        @endforeach
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
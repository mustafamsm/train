@extends('layouts.app')


@section('content')
<div class="container  ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="header text-center"><h3>Create</h3></div>
                <br> 
                <div class="body ">
                            <form action="{{route('posts.store')}}" method="post">
                                    @csrf
                                    <div class="form--group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>

                                    </div>
                                        <br> 
                                    <div class="form--group">
                                        <label for="description">Description</label>
                                        
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10"required></textarea>
                                    </div>
                                    <br> 
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
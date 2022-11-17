@extends('layouts.app')

@section('content')
<div class="container">
   
    @if (count($errors)>0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif
    @php
        $genderArray=['Male','Female'];
    @endphp
 <h1></h1>
<form action="{{route('profile.update')}}" method="POST">
    @csrf
    @method('PUT')
        <div class="form-group">
          <label for="name">  Name</label>
          <input type="text" name="name" id="name" class="form-control"  value="{{$user->name}}">
          @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
               @enderror
        </div>
        <div class="form-group">
            <label for="province">  province</label>
            <input type="text" name="province" id="province" class="form-control"  value="{{$user->profile->province}}">
            @error('province')
            <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
          </div>
        <div class="form-group">
            <label for="gender">  gender</label>
            <select  class="form-control" name="gender" id="gender">
                @foreach ($genderArray as $item )
                    
               
                <option value="{{$item}}">{{$item}}</option>
                
                @endforeach
            </select>
            @error('gender')
            <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
          </div>
          <div class="form-group">
            <label for="facebook">  facebook Profile Linke</label>
            <input type="text" name="facebook" id="facebook" class="form-control"  value="{{$user->profile->facebook}}">
            @error('facebook')
            <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
          </div>
        <div class="form-group">
          <label for="bio">Bio  </label>
          <textarea class="form-control" name="bio" id="bio"  rows="3">{!!$user->profile->bio!!}</textarea>
          @error('bio')
          <div class="alert alert-danger">{{ $message }}</div>
               @enderror
        </div>
        <div class="form-group">
            <label for="password"> password</label>
            <input type="password" name="password" id="password" class="form-control" >
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
          </div>
          <div class="form-group">
            <label for="c_password">  Cofirm password</label>
            <input type="password" name="c_password" id="c_password" class="form-control"  >
            @error('c_password')
            <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
          </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>

        </div>



    </form>
    </div
@endsection
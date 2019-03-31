@extends('layouts.appadmin')

@section('content')
<a href="/home" class="btn btn-default">GO BACK</a>
 <h1>Users</h1>
 @if(count($users)>0)
     @foreach($users as $user)
         <div class='well'>
             <div class="row">
                 {{-- <div class="col-md-4 cl-sm-4">
                 <img style="width:100%" src= "/storage/cover_images/{{$member->cover_image}}">
                 </div> --}}
                 <div class="col-md-4 cl-sm-4">
                            <h3>{{$user->name}}</h3>
                            <small>Email: {{$user->email}}</small>
                            <strong style="background-color:lime" >Role: {{$user->admin}}</strong>
                </div>
                <a href='{{"/changerole?id=".$user->id}}' class="btn btn-primary pull-right">Change Role</a>
                <a href='{{"/removeuser?id=".$user->id}}' class="btn btn-danger pull-right">Remove</a>
               
            </div>
           
          </div>
     @endforeach
    
 @else
    <p>No user registered Yet!</p>
 @endif              
@endsection
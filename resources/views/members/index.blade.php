@extends('layouts.app')

@section('content')
 <h1>This is our Members</h1>
 @if(count($members)>0)
     @foreach($members as $member)
         <div class='well'>
             <div class="row">
                 <div class="col-md-4 cl-sm-4">
                 <img style="width:100%" src= "/storage/cover_images/{{$member->cover_image}}">
                 </div>
                 <div class="col-md-4 cl-sm-4">
                        <h3><a href="/members/{{$member->id}}">{{$member->name}}</h3>
                            <small>Joined at {{$member->created_at}}</small>
                </div>
              
           
          </div>
     @endforeach
    
 @else
    <p>No Member Listed Yet!</p>
 @endif              
@endsection
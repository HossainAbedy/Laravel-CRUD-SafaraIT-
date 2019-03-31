@extends('layouts.appadmin')

@section('content')
<a href="/home" class="btn btn-default">GO BACK</a>
 <h1>Current Members</h1>
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
                    {{-- <a href="/admin/{{$member->id}}/adminedit" class="btn btn-primary pull-right">Edit</a> --}}
                    {!! Form::open(['action' => ['AdminController@destroy',$member->id],'method'=>'POST','class'=>'pull-right']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}  
                    {!! Form::close() !!}
                </div>
     @endforeach
    
 @else
    <p>No Member Listed Yet!</p>
 @endif              
@endsection
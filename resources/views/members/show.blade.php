@extends('layouts.app')

@section('content')
 <a href="/members" class="btn btn-default">GO BACK</a>
 <h1>{{$member->name}}</h1>
 <img style="width:100%" src= "/storage/cover_images/{{$member->cover_image}}">
 <small>Joined at {{$member->created_at}}</small>
           <div>
                <h2>Currently Working as : {{$member->positon}} </h2><br>
                <h3>{!!$member->body!!}</h3>
           </div>
           @if(!Auth::guest())
               @if(Auth::user()->id==$member->user_id)
                    <a href="/members/{{$member->id}}/edit" class="btn btn-primary">Edit</a>
                    {!! Form::open(['action' => ['MembersController@destroy',$member->id],'method'=>'POST','class'=>'pull-right']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}  
                    {!! Form::close() !!} 
               @endif
           @endif

@endsection
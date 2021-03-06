@extends('layouts.app')

@section('content')
<h1>Enter new member to the list</h1>
  {!! Form::open(['action' => 'MembersController@store','method'=>'POST','enctype' => 'multipart/form-data']) !!}
   <div class='form-group'>
       {{Form::label('name','Name')}}
       {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}
   </div>
   <div class='form-group'>
        {{Form::label('position','Position')}}
        {{Form::text('positon','',['class'=>'form-control','placeholder'=>'Positon'])}}
    </div>
    <div class='form-group'>
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}
        </div>
        <div class='form-group'>
          {{Form::file('cover_image')}}
      </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}  
{!! Form::close() !!}

{{-- <form action="MembersController@store" method="POST">
    Name:<br>
    <input type="text" name="name" value="" placeholder="Name">
    <br>
    Position:<br>
    <input type="text" name="positon" value="" placeholder="Name">
    <br>
    Details:<br>
    <input type="textarea" name="body" value="" placeholder="Name">
    <br><br>
    <input type="submit" class="btn btn-primary" value="Submit">
  </form>  --}}

@endsection
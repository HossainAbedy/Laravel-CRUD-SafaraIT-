@extends('layouts.app')

@section('content')
@if(!Auth::guest())
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/members/create" class="btn btn-primary">Add Member</a>  

                    <div class="alert alert-success">
                        You are logged in as user!
                    </div>
                   
                    {{-- @if(count($members)>0)
                    <table class='table table-striped'>
                        <tr>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                        </tr>
                     @foreach($members as $member)
                        <tr>
                        <th>{{$member->name}}</th>
                        <th><a href="/members/{{$member->id}}/edit" class="btn btn-default">Edit</th>
                            <th></th>
                        </tr>
                    @endforeach
                    </table>
                    @else
                    <p>You have No post</p>
                    @endif --}}
                </div>
            </div>
        </div>       
</div>
@else
<div class='jumbotron text-center'>You are logged out!</div> 
@endif
@endsection


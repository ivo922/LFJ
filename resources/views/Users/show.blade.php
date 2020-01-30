@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div class="card col-4 text-center" style="padding:10px 5%;">
            <strong>ID: <span class="mark">{{ $user->id }}</span></strong><br />
            <strong>Username: <span class="mark">{{ $user->name }}</span></strong><br />
            <strong>E-Mail: <span class="mark">{{ $user->email }}</span></strong>
        </div>
        <div class="card col-6 text-center" style="padding:10px 5% 0;">
            <strong>Companies: 
            @foreach($companies as $key => $value)
                <span class="mark">{{ $value->name }} </span>
            @endforeach</strong>
        </div>
        <div class="card col-2 text-center" style="padding:10px 0;">
            <a href="{{ url('edituser', $user->id) }}"><button class="btn btn-warning" style="width:70%">Edit</button></a>
            @if ($user->isBanned == 0)
                <!--<a href="{{ url('banuser', $user->id) }}" onclick="return confirm('Are you sure you want to ban this user?');">
                <button class="btn btn-dark" style="width:70%">Ban</button>
                </a>-->
                <form action="{{ url('banuser', $user->id) }}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="POST">
                <button class="btn btn-dark" type="submit" onclick="return confirm('Are you sure you want to ban this user?');" 
                style="width:70%">Ban</button>
            </form>
            @else
                <!--<a href="{{ url('banuser', $user->id) }}" onclick="return confirm('Are you sure you want to unban this user?');">
                <button class="btn btn-light" style="width:70%">Unban</button>
                </a>-->
                <form action="{{ url('banuser', $user->id) }}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="POST">
                <button class="btn btn-light" type="submit" onclick="return confirm('Are you sure you want to unban this user?');" 
                style="width:70%">Unban</button>
            </form>
            @endif
            <form action="{{action('UsersController@destroy', $user->id )}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this user?');" 
                style="width:70%">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection
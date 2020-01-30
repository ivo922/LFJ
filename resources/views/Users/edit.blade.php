@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div class="card col-md-6">
            <div class="card-header">Edit user {{ $user->name }}</div>
            <div class="card-body text-center">
                <form method="post" action="{{ url('updateuser', $user->id )}}">
                    <div class="form-group row">
                    {{csrf_field()}}
                        <input name="_method" type="hidden" value="POST">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-8">
                            <input id="name" class="form-control form-control-lg" type="text" placeholder="name" name="name" value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                        <div class="col-md-8">
                            <input id="email" class="form-control form-control-lg" type="text" placeholder="email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isAdmin" class="col-md-4 col-form-label text-md-right">Admin rights?</label>

                        @if ($user->isAdmin == 1)
                        <div class="col-md-3 form-check">
                            <input id="isAdmin" class="form-check-input" type="radio" placeholder="isAdmin" name="isAdmin" value="0">No<br />
                            <input id="isAdmin" class="form-check-input" type="radio" placeholder="isAdmin" name="isAdmin" value="1" checked> Yes
                        </div>
                        @else
                        <div class="col-md-3 form-check">
                            <input id="isAdmin" class="form-check-input" type="radio" placeholder="isAdmin" name="isAdmin" value="0" checked>No<br />
                            <input id="isAdmin" class="form-check-input" type="radio" placeholder="isAdmin" name="isAdmin" value="1"> Yes
                        </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 offset-md-5">
                            <button type="submit" class="btn btn-outline-primary" onclick="return confirm('Are you sure you want to change this item?');">Update</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
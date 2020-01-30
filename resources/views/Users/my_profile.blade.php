@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-3">
            
        </div>
    </div>
</div>

@endsection
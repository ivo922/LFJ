@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class=card-header" style="width:1000px">
            <span class="float-left"><a href="{{ url('jobs') }}">All Jobs</a> >> <strong>{{ $job -> position }}</strong></span>
            <span class="float-right">Published on {{ $date }}</span>
        </div>
        <div class="card" style="width:1000px; padding:10px 5%;">
            
        </div>
    </div>
</div>

@endsection
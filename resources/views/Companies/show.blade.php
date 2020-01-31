@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div class="card col-md-8 text-center" style="padding:20px 0">
            <img src="<?php echo asset('storage/' . $company->logo)?>" alt="logo" maxheight="200px" width="auto" style="margin:0 auto"/>
            <h1 style="margin:10px">{{ $company->name }}</h1>
            <p>{{ $company->description }}</p>
        </div>
        <div class="card col-md-4 text-center">
            <span class="mark">Job offers by {{ $company->name }}:</span>
        </div>
    </div>
</div>

@endsection
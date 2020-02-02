@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="card-header col-md-12">
            <span class="float-left"><a href="{{ url('jobs') }}">All Jobs</a> >> <strong>{{ $job -> position }}</strong></span>
            <span class="float-right">Published on {{ $date }}</span>
        </div>
        <div class="card col-md-12" style="padding:10px 5%">
            <div class="table-cell">
            <span style="font-size:1.1rem; color:green"><strong>{{ $job -> position }}</strong></span> by <a href="{{ url('companies/' . $company->id) }}">{{ $job -> company }}</a><br />
                <span class="small mark" style="color:grey"><strong>{{ $job -> category }}</strong></span> 
                <span class="small mark" style="color:grey"><strong>{{ $job -> type }}</strong></span> 
                <span class="small mark" style="color:grey"><strong>{{ $job -> place }}</strong></span>
            </div>
            <hr />
            <img src="<?php echo asset('storage/' . $company->logo)?>" alt="logo" width="auto" style="margin:0 auto; max-height:200px"/>
            <p class="text-center" style="margin-top:20px">{{ $job->description }}</p>
        </div>
    </div>
</div>

@endsection
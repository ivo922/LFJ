@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="card-header col-md-10">
            <span><a href="/">Home</a> >> <strong>Jobs</strong></span>
            @if(Auth::check())
            <span class="float-right"><a href="{{ url('jobs/create') }}"><button class="btn btn-success btn-sm">Create</button></a></span>
            @endif
        </div>
        <div class="card col-md-10" style="padding:10px 5%;">
            <table class="table">
                <tbody>
                    @foreach($allJobs as $key => $value)
                    <tr height="70px">
                        <td width="70%" style="vertical-align: middle">
                            <span style="font-size:1.1rem"><strong><a href="{{url('showjob', $value->id )}}">{{ $value -> position }}</a></strong></span><br />
                            <span class="small mark" style="color:grey"><strong>{{ $value -> category }}</strong></span> 
                            <span class="small mark" style="color:grey"><strong>{{ $value -> type }}</strong></span> 
                            <span class="small mark" style="color:grey"><strong>{{ $value -> place }}</strong></span>
                        </td>
                        <td>
                            <img src="<?php echo asset('storage/' . $value->logo);?>" alt="logo" style="max-height:75px; max-width:120px; height:auto; width:auto;" width="auto"/>
                        </td>
                        <td style="text-align:center; vertical-align: middle">
                            {{ $value->company }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
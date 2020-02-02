@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-10 search-field" style="padding:10px 0;">
            <p class="text-center">
                Looking for a specific job? <br />Use the search function to find the right job!.
            </p>
            <form action={{ url('jobsearch') }} method="POST" role="search">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input type="text" class="form-control" name="searchField"
                            placeholder="Find a job!" style="margin: 0 auto">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-5 offset-md-5">
                        <button type="submit" class="btn btn-success btn-sm">
                            <strong>Search</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-header row col-md-10">
            <span class="my-auto col-md-10"><a href="/">Home</a> >> <strong>Jobs</strong></span>
            @if(Auth::check())
            <span class="float-right col-md-2"><a href="{{ url('jobs/create') }}"><button class="btn btn-success btn-sm">Create</button></a></span>
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
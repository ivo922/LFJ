@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div class="card-header row col-md-12">
            <span class="float-left my-auto col-md-8"><a href="{{ url('companies') }}">All Companies</a> >> <strong>{{ $company->name }}</strong></span>
            @if($isLoggedIn == 1)
                @if ($user->isAdmin == 1 || $user->id == $company->userID)
                <span class="float-right col-md-4">
                    <a href="{{ url('companies/' . $company->id . '/edit') }}"><button class="btn btn-warning btn-sm">Edit</button></a>
                    <a href="{{ url('users', $company->userID) }}"><button class="btn btn-warning btn-sm">View User</button></a>
                    <form style="display:inline" action="{{action('CompaniesController@destroy', $company->id )}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-sm" type="submit" 
onclick="return confirm('Are you sure you want to delete this company? All job offers submitted from this company will be deleted as well.');">Delete</button>
                    </form>
                </span>
                @endif
            @endif
        </div>
        <div class="card col-md-8 text-center" style="padding:20px 10px">
            <img src="<?php echo asset('storage/' . $company->logo)?>" alt="logo" width="auto" style="margin:0 auto; max-height:200px"/>
            <h1 style="margin:10px">{{ $company->name }}</h1>
            <p>{{ $company->description }}</p>
        </div>
        <div class="card col-md-4" style="padding-top:10px;">
            <span style="font-size:1.2rem; margin:5px auto 0;"><strong>Job offers by {{ $company->name }}:</strong></span><br />
            @if ($isJobsEmpty == 1)
                <img src="\images\noresults.png" alt="no-results" width="220" height="110" style="margin:0 auto 20px"/>
                <span class="text-center"><em>Currently there are no job offers by this company :( <br />
                But feel free to browse the complete list <a style="text-decoration:none" href="{{ url('jobs') }}">here</a>.</em></span>
            @else
                <table class="table">
                @foreach($jobs as $key => $value)
                    <tr height="70px">
                        <td width="70%" style="vertical-align: middle">
                            <span style="font-size:1.1rem"><strong><a href="{{url('showjob', $value->id )}}">{{ $value -> position }}</a></strong></span>
                            <span class="small float-right" style="color:grey">{{ substr($value -> created_at, 0, 10) }}</span><br />
                            <span class="small mark" style="color:grey"><strong>{{ $value -> category }}</strong></span> 
                            <span class="small mark" style="color:grey"><strong>{{ $value -> type }}</strong></span> 
                            <span class="small mark" style="color:grey"><strong>{{ $value -> place }}</strong></span>
                        </td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
@if ($errors->first('title'))
<div class="alert alert-danger">{{ $errors->first('logo') }}</div>
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="card-header row col-md-12">
      <span class="float-left my-auto col-md-8"><a href="{{ url('companies', $company->id) }}">{{ $company->name }}</a> >> <strong>Edit</strong></span>
      <span class="float-right col-md-4">
        <form style="display:inline" action="{{action('CompaniesController@destroy', $company->id )}}" method="post">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="DELETE">
          <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this company? All job offers submitted from this company will be deleted as well.');">Delete</button>
        </form>
      </span>
    </div>
    <!--Header End-->
    <div class="card col-md-12 text-center" style="padding:20px 10px">
      <h2><strong>Edit <span style="color:green">{{ $company->name }}</span></strong></h2>
      <hr />
      <form method="post" action="{{action('CompaniesController@update', $company->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <!--Name-->
        <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">Change name:</label>

          <div class="col-md-6">
            <input id="name" class="form-control" type="text" name="name">
          </div>
        </div>
        <!--Logo-->
        <div class="form-group row">
          <label for="logo" class="col-md-4 col-form-label text-md-right">Upload a new Logo:</label>

          <div class="col-md-6">
            <input id="logo" class="form-control-file border" type="file" accept="image/png, .jpeg, .jpg" name="logo">
          </div>
        </div>
        <!--Description-->
        <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label text-md-right">Change description:</label>

          <div class="col-md-6">
            <textarea id="description" class="form-control" type="text" rows="5" name="description">{{ $company->description }}</textarea>
          </div>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-success">
              Update
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
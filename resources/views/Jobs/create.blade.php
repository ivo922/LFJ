@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Publish a Job Offer</div>
                        <div class="card-body">
                            <form method="post" action="{{url('jobs')}}">
                            {{csrf_field()}}
                            <!--Position-->
                                <div class="form-group row">
                                    <label for="position" class="col-md-4 col-form-label text-md-right">Position:</label>

                                    <div class="col-md-6">
                                        <input id="position" class="form-control" type="text" name="position">
                                    </div>
                                </div>
                            <!--Category-->
                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label text-md-right">Category:</label>

                                    <div class="col-md-6">
                                        <input id="category" class="form-control" type="text" name="category">
                                    </div>
                                </div>
                            <!--Place-->
                                <div class="form-group row">
                                    <label for="place" class="col-md-4 col-form-label text-md-right">Place:</label>

                                    <div class="col-md-6">
                                        <input id="place" class="form-control" type="text" name="place">
                                    </div>
                                </div>
                            <!--Company-->
                                <div class="form-group row">
                                    <label for="company" class="col-md-4 col-form-label text-md-right">Company:</label>

                                    <div class="col-md-6">
                                        <select id="company" class="form-control" name="company">
                                            @foreach($companies as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            <!--Type-->
                                <div class="form-group row">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">Type:</label>

                                    <div class="col-md-6">
                                        <select id="type" class="form-control" name="type">
                                            <option value="Full-Time">Full-Time</option>
                                            <option value="Part-Time">Part-Time</option>
                                            <option value="Internship">Internship</option>
                                        </select>
                                    </div>
                                </div>
                        <!--Description-->
                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>

                                    <div class="col-md-6">
                                        <textarea id="description" class="form-control" type="text" rows="5" name="description" placeholder="Describe."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                        Publish
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>

@endsection
                            
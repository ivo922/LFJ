@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a Company</div>
                    <div class="card-body">
                        <form method="post" action="{{url('companies')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!--Name-->
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Give it a name:</label>

                                <div class="col-md-6">
                                    <input id="name" class="form-control" type="text" name="name">
                                </div>
                            </div>
                        <!--Logo-->
                            <div class="form-group row">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">Upload Logo:</label>

                                <div class="col-md-6">
                                    <input id="logo" class="form-control-file border" type="file" accept="image/png, .jpeg, .jpg" name="logo">
                                </div>
                            </div>
                        <!--Description-->
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Describe your company:</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" type="text" rows="5" name="description" placeholder="Max. 255 characters."></textarea>
                                </div>
                            </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                        Create
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
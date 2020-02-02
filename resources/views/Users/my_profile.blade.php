@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center" >
        <div id="sidebar" class="col-md-3 text-center">
            <button id="my_profile-menu" class="btn btn-success btn-sm shadow-none tablinks" style="width:100%" onclick="openTab(event, 'my_profile')">My Profile</button>
            <button id="my_companies-menu" class="btn btn-outline-success btn-sm shadow-none tablinks" style="margin-top:2px; width:100%" onclick="openTab(event, 'my_companies')">My Companies</button>
            <button id="change_password-menu" class="btn btn-outline-success btn-sm shadow-none tablinks" style="margin-top:2px; width:100%" onclick="openTab(event, 'change_password')">Change Password</button>
            <button id="change_email-menu" class="btn btn-outline-success btn-sm shadow-none tablinks" style="margin-top:2px; width:100%" onclick="openTab(event, 'change_email')">Change E-mail</button>
            <button id="delete_account-menu" class="btn btn-danger btn-sm btn-radius shadow-none tablinks" style="margin-top:10px;">Delete Account</button>
        </div>
        <div class="card col-md-9">
        <!--My Profile-->
            <div id="my_profile" class="card-body text-center tabcontent">
                <span>Username: {{ $user-> name }}<span><br />
                <span>E-mail: {{ $user -> email }}</span><br />
            </div>
        <!--Change Password-->
            <div id="change_password" class="card-body tabcontent" style="display: none">
                <form method="post" action="{{url('updatePassword')}}">
                  <div class="form-group row">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="POST">
                      <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                        <div class="col-md-8">
                            <input id="password" class="form-control form-control" type="password" placeholder="Enter your current password." name="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>

                        <div class="col-md-8">
                            <input id="new_password" class="form-control form-control" type="password" placeholder="Enter your new password (min: 8 characters)" name="new_password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                        <div class="col-md-8">
                            <input id="new_password_confirmation" class="form-control form-control" type="password" placeholder="Confirm your new password." name="new_password_confirmation">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 offset-md-5">
                            <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Are you sure you want to change your password?');">Update</button>
                        </div>
                    </div>
                  </form>
            </div>
        <!--Change E-mail-->
            <div id="change_email" class="card-body tabcontent" style="display: none">
                <form method="post" action="{{ url('updateuser', $user->id) }}">
                  <div class="form-group row">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="POST">
                      <label for="current-password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                        <div class="col-md-8">
                            <input id="current-password" class="form-control form-control" type="text" placeholder="Enter your current password." name="current-password">
                        </div>
                  </div>

                  <div class="form-group row">
                      <label for="email" class="col-md-4 col-form-label text-md-right">New E-mail</label>

                      <div class="col-md-8">
                          <input id="email" class="form-control form-control" type="text" placeholder="Enter your new E-mail address." name="email">
                      </div>
                  </div>

                  <div class="form-group row">
                        <div class="col-md-2 offset-md-5">
                            <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Are you sure you want to change your E-mail?');">Update</button>
                        </div>
                    </div>
                </form>
            </div>

        <!--My Companies-->
            <div id="my_companies" class="card-body tabcontent" style="display: none">
                <div class="row">
                <div class="card-header col-md-12">
                    <span class="float-right"><a href="{{ url('companies/create') }}"><button class="btn btn-success btn-sm">Create</button></a></span>
                </div>
                @foreach($companies as $key => $value)
			        <div class="col-md-6">
				        <div class="card mb-3">
					        <div class="row no-gutters align-items-center">
						        <div class="col-md-4">
							        <img src="<?php echo asset('storage/' . $value->logo)?>" class="card-img img-thumbnail" alt="image" style="object-fit:cover">
						        </div>
						        <div class="col-md-8">
							        <div class="card-body">
								        <h5 class="card-title"><a href="{{ url('companies', $value->id) }}">{{ $value->name }}</a></h5>
								        <p class="card-text">{{ substr($value->description, 0, 100) }}...</p>
							        </div>
						        </div>
					        </div>
                            <div class="float-right position-absolute" style="bottom:5px; right:5px;">
                                
                            </div>
				        </div>
			        </div>
                @endforeach
	            </div>
            </div>
    </div>
</div>

@endsection
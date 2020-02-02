@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-10 search-field" style="padding:10px 0;">
			<p class="text-center">
					Looking for a specific user? <br />Use the search function to find them!.
			</p>
			<form action={{ url('usersearch') }} method="POST" role="search">
					{{ csrf_field() }}
					<div class="form-group row">
							<div class="col-md-6 offset-md-4">
									<input type="text" class="form-control" name="searchField"
											placeholder="Search!" style="margin: 0 auto">
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
        <div class="card col-md-10" style="padding:10px 5%;">
            <table class="table">
                <tbody>
                    @foreach($allUsers as $key => $value)
                    <tr height="70px">
                        <td width="70%">
                            <span style="font-size:1.1rem"><strong><a href="{{url('showuser', $value->id )}}">{{ $value -> name }}</a></strong></span><br />
                            <span class="small mark" style="color:grey"><strong>{{ $value -> email }}</strong></span> 
                            @if ($value->isAdmin == true)
                              <span class="small mark" style="color:grey"><strong>Admin</strong></span> 
                            @endif
                            @if ($value -> isBanned == true)
                              <span class="small mark" style="color:grey"><strong>Banned</strong></span> 
                            @endif
                        </td>
                        @if ($user->isAdmin != 0)
                        <td class="float-right">
                            <form action="{{action('UsersController@destroy', $value->id )}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
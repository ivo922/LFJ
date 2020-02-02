@extends('layouts.app')

@section('content')
    @if ($errors->first('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
    @endif

<div class="container">
  <div class="row justidy-content-center">
		<div class="card col-md-12 search-field" style="padding:10px 0;">
			<p class="text-center">
					Looking for your next employer? <br />Use the search function to find it!.
			</p>
			<form action={{ url('companysearch') }} method="POST" role="search">
					{{ csrf_field() }}
					<div class="form-group row">
							<div class="col-md-8 offset-md-2">
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
    @foreach($companies as $key => $value)
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="row no-gutters align-items-center">
						<div class="col-md-4">
							<img src="<?php echo asset('storage/' . $value->logo)?>" class="card-img img-thumbnail" alt="image" style="object-fit:cover">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">{{ $value->name }}</h5>
								<p class="card-text">{{ substr($value->description, 0, 100) }}...</p>
							</div>
						</div>
					</div>
          <div class="float-right position-absolute" style="bottom:5px; right:5px;">
            <a href="{{ url('companies', $value->id) }}"><button class="btn btn-success btn-sm">View Profile</button></a>
          </div>
				</div>
			</div>
    @endforeach
	</div>
</div>

@endsection
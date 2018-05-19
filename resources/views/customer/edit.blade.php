@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Customer</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ url('customer') }}/{{ $customer->id }}/update">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ $customer->name }}" required autofocus>

								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
							<label for="address" class="col-md-4 control-label">Address</label>

							<div class="col-md-6">
								<textarea id="address" class="form-control" name="address" required>{{ $customer->address }}</textarea>

								@if ($errors->has('address'))
								<span class="help-block">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
							<label for="phone" class="col-md-4 control-label">Phone</label>

							<div class="col-md-6">
								<input id="phone" type="number" class="form-control" name="phone" value="{{ $customer->phone }}" required autofocus>

								@if ($errors->has('phone'))
								<span class="help-block">
									<strong>{{ $errors->first('phone') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
							<label for="gender" class="col-md-4 control-label">Gender</label>

							<div class="col-md-6">								
								<select class="form-control" data-toggle="dropdown" id="gender" name="gender" required >									
									<option {{ $customer->gender == 'Male' ? 'selected' : '' }}>Male</option>
									<option {{ $customer->gender == 'Female' ? 'selected' : '' }}>Female</option>
									<option {{ $customer->gender == 'Other' ? 'selected' : '' }}>Other</option>
								</select>

								@if ($errors->has('phone'))
								<span class="help-block">
									<strong>{{ $errors->first('phone') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit
								</button>
								<a href="{{ url('customer') }}/{{ $customer->id }}/show" class="btn btn-danger">Cancel</a>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

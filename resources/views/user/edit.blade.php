
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit User</div>

				<div class="panel-body">
					@if (session('error'))
					<div class="alert alert-danger">
						{{ session('error') }}
					</div>
					@endif
					@if (session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif
					<form class="form-horizontal" method="POST" action="{{ url('users') }}/{{ $user->id }}/update">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
							<label for="fullname" class="col-md-4 control-label">Fullname</label>

							<div class="col-md-6">
								<input id="fullname" type="text" class="form-control" name="fullname" value="{{ $user->fullname }}" required autofocus>

								@if ($errors->has('fullname'))
								<span class="help-block">
									<strong>{{ $errors->first('fullname') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
							<label for="level" class="col-md-4 control-label">Level</label>

							<div class="col-md-6">
								<select id="level" type="text" class="form-control" name="level" required autofocus>                                    
									<option value="1" {{ $user->level == '1' ? 'selected' : '' }}>User</option>
									<option value="2" {{ $user->level == '2' ? 'selected' : '' }}>Admin</option>
								</select>                                

								@if ($errors->has('level'))
								<span class="help-block">
									<strong>{{ $errors->first('level') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
							<label for="new-password" class="col-md-4 control-label">Current Password</label>

							<div class="col-md-6">
								<input id="current-password" type="password" class="form-control" name="current-password">

								@if ($errors->has('current-password'))
								<span class="help-block">
									<strong>{{ $errors->first('current-password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
							<label for="new-password" class="col-md-4 control-label">New Password</label>

							<div class="col-md-6">
								<input id="new-password" type="password" class="form-control" name="new-password">

								@if ($errors->has('new-password'))
								<span class="help-block">
									<strong>{{ $errors->first('new-password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

							<div class="col-md-6">
								<input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

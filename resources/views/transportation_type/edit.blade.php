@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Transportation Type</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ url('transportation_type') }}/{{ $transport_type->id }}/update">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label for="description" class="col-md-4 control-label">Description</label>

							<div class="col-md-6">								
								<textarea id="description" class="form-control" name="description" required>{{ $transport_type->description }}</textarea>

								@if ($errors->has('description'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit
								</button>
								<a href="{{ url('transportation_type') }}/{{ $transport_type->id }}/show" class="btn btn-danger">Cancel</a>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

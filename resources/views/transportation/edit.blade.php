@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Transportation Type</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ url('transportation') }}/{{ $transportation->id }}/update">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
							<label for="code" class="col-md-4 control-label">Code</label>

							<div class="col-md-6">
								<input id="code" type="number" class="form-control" name="code" placeholder="{{ $transportation->code }}">

								@if (session('code_error'))
								<span class="help-block">
									<strong>{{ session('code_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('code'))
								<span class="help-block">
									<strong>{{ $errors->first('code') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label for="description" class="col-md-4 control-label">Description</label>

							<div class="col-md-6">
								<textarea id="description" class="form-control" name="description" required>{{ $transportation->description }}</textarea>

								@if ($errors->has('description'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div> -->

						<div class="form-group{{ $errors->has('seat_qty') ? ' has-error' : '' }}">
							<label for="seat_qty" class="col-md-4 control-label">Seat QTY</label>

							<div class="col-md-6">
								<input id="seat_qty" type="number" class="form-control" name="seat_qty" value="{{ $transportation->seat_qty }}" required autofocus>

								@if ($errors->has('seat_qty'))
								<span class="help-block">
									<strong>{{ $errors->first('seat_qty') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('transportation_typeid') ? ' has-error' : '' }}">
							<label for="transportation_typeid" class="col-md-4 control-label">Transportation Type ID</label>

							<div class="col-md-6">		
								<input type="number" placeholder="{{ $transportation->transportation_typeid }}" class="form-control" name="transportation_typeid" list="listid" id="transportation_typeid">
								<datalist id="listid">
									@foreach($transport_type as $transtype)
									<option value="{{ $transtype->id }}">{{$transtype->description}}</option>
									@endforeach
								</datalist>								

								@if (session('transtypeid_error'))
								<span class="help-block">
									<strong>{{ session('transtypeid_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('transportation_typeid'))
								<span class="help-block">
									<strong>{{ $errors->first('transportation_typeid') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit
								</button>
								<a href="{{ url('transportation') }}/{{ $transportation->id }}/show" class="btn btn-danger">Cancel</a>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

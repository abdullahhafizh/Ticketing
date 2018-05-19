@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit route Type</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ url('route') }}/{{ $route->id }}/update">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('depart_at') ? ' has-error' : '' }}">
							<label for="depart_at" class="col-md-4 control-label">Depart At</label>

							<div class="col-md-6">
								<input id="depart_at" type="text" class="form-control" name="depart_at" value="{{ $route->depart_at }}">								

								@if ($errors->has('depart_at'))
								<span class="help-block">
									<strong>{{ $errors->first('depart_at') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('route_from') ? ' has-error' : '' }}">
							<label for="route_from" class="col-md-4 control-label">Route From</label>

							<div class="col-md-6">
								<input type="text" name="route_from" id="route_from" class="form-control" value="{{ $route->route_from }}" autofocus required>

								@if ($errors->has('route_from'))
								<span class="help-block">
									<strong>{{ $errors->first('route_from') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('route_to') ? ' has-error' : '' }}">
							<label for="route_to" class="col-md-4 control-label">Route To</label>

							<div class="col-md-6">
								<input type="text" name="route_to" id="route_to" class="form-control" value="{{ $route->route_to }}" autofocus required>

								@if ($errors->has('route_to'))
								<span class="help-block">
									<strong>{{ $errors->first('route_to') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
							<label for="price" class="col-md-4 control-label">Price</label>

							<div class="col-md-6">
								<input id="price" type="number" class="form-control" name="price" value="{{ $route->price }}" required autofocus>

								@if ($errors->has('price'))
								<span class="help-block">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('transportationid') ? ' has-error' : '' }}">
							<label for="transportationid" class="col-md-4 control-label">Transportation ID</label>

							<div class="col-md-6">		
								<input type="number" placeholder="{{ $route->transportationid }}" class="form-control" name="transportationid" list="listid" id="transportationid">
								<datalist id="listid">
									@foreach($transportations as $transportation)
									<option value="{{ $transportation->id }}">{{$transportation->code}} - {{$transportation->description}}</option>
									@endforeach
								</datalist>								

								@if (session('transportationid_error'))
								<span class="help-block">
									<strong>{{ session('transportationid_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('transportationid'))
								<span class="help-block">
									<strong>{{ $errors->first('transportationid') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit
								</button>
								<a href="{{ url('route') }}/{{ $route->id }}/show" class="btn btn-danger">Cancel</a>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

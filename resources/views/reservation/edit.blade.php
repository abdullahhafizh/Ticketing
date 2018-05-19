@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Reservation</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ url('reservation') }}/{{ $reservation->id }}/update">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('reservation_code') ? ' has-error' : '' }}">
							<label for="reservation_code" class="col-md-4 control-label">Reservation Code</label>

							<div class="col-md-6">
								<input id="reservation_code" type="number" class="form-control" name="reservation_code" placeholder="{{ $reservation->reservation_code }}">

								@if (session('reservation_error'))
								<span class="help-block">
									<strong>{{ session('reservation_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('reservation_code'))
								<span class="help-block">
									<strong>{{ $errors->first('reservation_code') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('reservation_from') ? ' has-error' : '' }}">
							<label for="reservation_from" class="col-md-4 control-label">Reservation At</label>

							<div class="col-md-6">
								<input type="text" name="reservation_at" id="reservation_at" class="form-control" value="{{ $reservation->reservation_at }}" autofocus required>

								@if ($errors->has('reservation_at'))
								<span class="help-block">
									<strong>{{ $errors->first('reservation_at') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('reservation_date') ? ' has-error' : '' }}">
							<label for="reservation_date" class="col-md-4 control-label">Reservation Date</label>

							<div class="col-md-6">
								<input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ $reservation->reservation_date }}" autofocus required>

								@if ($errors->has('reservation_date'))
								<span class="help-block">
									<strong>{{ $errors->first('reservation_date') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('customerid') ? ' has-error' : '' }}">
							<label for="customerid" class="col-md-4 control-label">Customer ID</label>

							<div class="col-md-6">		
								<input type="number" placeholder="{{ $reservation->customerid }}" class="form-control" name="customerid" list="listcustomerid" id="customerid">
								<datalist id="listcustomerid">
									@foreach($customers as $customer)
									<option value="{{ $customer->id }}">{{$customer->name}}</option>
									@endforeach
								</datalist>								

								@if (session('customer_error'))
								<span class="help-block">
									<strong>{{ session('customer_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('customerid'))
								<span class="help-block">
									<strong>{{ $errors->first('customerid') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('seat_code') ? ' has-error' : '' }}">
							<label for="seat_code" class="col-md-4 control-label">Seat Code</label>

							<div class="col-md-6">
								<input id="seat_code" type="number" class="form-control" name="seat_code" value="{{ $reservation->seat_code }}" required autofocus>

								@if ($errors->has('seat_code'))
								<span class="help-block">
									<strong>{{ $errors->first('seat_code') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('routeid') ? ' has-error' : '' }}">
							<label for="routeid" class="col-md-4 control-label">Route ID</label>

							<div class="col-md-6">		
								<input type="number" placeholder="{{ $reservation->routeid }}" class="form-control" name="routeid" list="listrouteid" id="routeid">
								<datalist id="listrouteid">
									@foreach($routes as $route)
									<option value="{{ $route->id }}">{{$route->name}}</option>
									@endforeach
								</datalist>								

								@if (session('route_error'))
								<span class="help-block">
									<strong>{{ session('route_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('routeid'))
								<span class="help-block">
									<strong>{{ $errors->first('routeid') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('depart_at') ? ' has-error' : '' }}">
							<label for="depart_at" class="col-md-4 control-label">Depart At</label>

							<div class="col-md-6">
								<input type="text" name="depart_at" id="depart_at" class="form-control" value="{{ $reservation->depart_at }}" autofocus required>

								@if ($errors->has('depart_at'))
								<span class="help-block">
									<strong>{{ $errors->first('depart_at') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
							<label for="price" class="col-md-4 control-label">Price</label>

							<div class="col-md-6">
								<input id="price" type="number" class="form-control" name="price" value="{{ $reservation->price }}">								

								@if ($errors->has('price'))
								<span class="help-block">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
								@endif
							</div>
						</div> -->

						<div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
							<label for="userid" class="col-md-4 control-label">User ID</label>

							<div class="col-md-6">		
								<input type="number" placeholder="{{ $reservation->userid }}" class="form-control" name="userid" list="listuserid" id="userid">
								<datalist id="listuserid">
									@foreach($users as $user)
									<option value="{{ $user->id }}">{{$user->name}}</option>
									@endforeach
								</datalist>								

								@if (session('user_error'))
								<span class="help-block">
									<strong>{{ session('user_error') }}</strong>
								</span>
								@endif

								@if ($errors->has('userid'))
								<span class="help-block">
									<strong>{{ $errors->first('userid') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit
								</button>
								<a href="{{ url('reservation') }}/{{ $reservation->id }}/show" class="btn btn-danger">Cancel</a>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

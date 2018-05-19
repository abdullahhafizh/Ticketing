@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data Reservation</div>

				<div class="panel-body">
					@if(sizeof($reservations)==0)
					@else          
					<div class="table-responsive">						
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Reservation Code</th>                                    
									<th>Reservation At</th>
									<th>Reservation Date</th>
									<th>Customer ID</th>
									<th>Seat Code</th>
									<th>Route ID</th>
									<th>Depart At</th>
									<th>Price</th>
									<th>User ID</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($reservations as $reservation)                            
								<tr>                                    
									<td>{{ $reservation->id }}</td>
									<td>{{ $reservation->reservation_code }}</td>
									<td>{{ $reservation->reservation_at }}</td>
									<td>{{ $reservation->reservation_date }}</td>
									<td>{{ $reservation->customerid }}</td>
									<td>{{ $reservation->seat_code }}</td>
									<td>{{ $reservation->routeid }}</td>
									<td>{{ $reservation->depart_at }}</td>
									<td>{{ $reservation->price }}</td>
									<td>{{ $reservation->userid }}</td>
									<td><a href="{{ url('reservation')}}/{{ $reservation->id }}/show" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<b>View</b></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif					     
					<div class="row">
						<div class="col-md-6">                            
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal" style="width: 100%;">Tambah Reservation</button>

							<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Tambah Reservation</h4>
										</div>
										<form id="create-form" method="POST" action="{{ url('reservation/create') }}" style="overflow-y: scroll;height: 400px;">
											<div class="modal-body">                                                
												{{ csrf_field() }}
												
												<div class="form-group{{ $errors->has('reservation_at') ? ' has-error' : '' }}">
													<label for="reservation_at" class="control-label">Reservation At</label>

													<input id="reservation_at" type="text" class="form-control" name="reservation_at" value="{{ old('reservation_at') }}" required autofocus>

													@if ($errors->has('reservation_at'))
													<span class="help-block">
														<strong>{{ $errors->first('reservation_at') }}</strong>
													</span>
													@endif
												</div>

												<!-- <div class="form-group{{ $errors->has('reservation_date') ? ' has-error' : '' }}">
													<label for="reservation_date" class="control-label">Reservation Date</label>

													<input id="reservation_date" type="date" class="form-control" name="reservation_date" value="{{ old('reservation_date') }}" required autofocus readonly>

													@if (session('date_error'))
													<span class="help-block">	
														<strong>{{ session('date_error') }}</strong>
													</span>
													@endif

													@if ($errors->has('reservation_date'))
													<span class="help-block">
														<strong>{{ $errors->first('reservation_date') }}</strong>
													</span>
													@endif                                            
												</div> -->

												<div class="form-group{{ $errors->has('customerid') ? ' has-error' : '' }}">
													<label for="customerid" class="control-label">Customer ID</label>

													<input type="number" class="form-control" name="customerid" list="listcustomerid" 
													id="customerid" value="{{ old('customerid') }}" autofocus required>
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

												<div class="form-group{{ $errors->has('seat_code') ? ' has-error' : '' }}">
													<label for="seat_code" class="control-label">Seat Code</label>

													<input id="seat_code" type="number" class="form-control" name="seat_code" value="{{ old('seat_code') }}" required autofocus>

													@if ($errors->has('seat_code'))
													<span class="help-block">
														<strong>{{ $errors->first('seat_code') }}</strong>
													</span>
													@endif          
												</div>

												<div class="form-group{{ $errors->has('routeid') ? ' has-error' : '' }}">
													<label for="routeid" class="control-label">Route ID</label>

													<input type="number" class="form-control" name="routeid" list="listrouteid" id="routeid" value="{{ old('routeid') }}" autofocus required>
													<datalist id="listrouteid">
														@foreach($routes as $route)
														<option value="{{ $route->id }}">Depart : {{$route->depart_at}} | From: {{$route->route_from}} | To: {{$route->route_to}}</option>
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

												<div class="form-group{{ $errors->has('depart_at') ? ' has-error' : '' }}">
													<label for="depart_at" class="control-label">Depart At</label>

													<input id="depart_at" type="text" class="form-control" name="depart_at" value="{{ old('depart_at') }}" required autofocus>

													@if ($errors->has('depart_at'))
													<span class="help-block">
														<strong>{{ $errors->first('depart_at') }}</strong>
													</span>
													@endif                                            
												</div>

												<!-- <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
													<label for="price" class="control-label">Price</label>

													<input type="number" min="1" max="999999999" class="form-control" name="price" id="price" value="{{ old('price') }}" autofocus required>

													@if ($errors->has('price'))
													<span class="help-block">
														<strong>{{ $errors->first('price') }}</strong>
													</span>
													@endif                                            
												</div> -->

												<!-- <div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
													<label for="userid" class="control-label">User ID</label>

													<input type="number" class="form-control" name="userid" list="listuserid" id="userid" value="{{ old('userid') }}" autofocus required>
													<datalist id="listuserid">
														@foreach($users as $user)
														<option value="{{ $user->id }}">{{$user->fullname}}</option>
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
												</div> -->

											</div>
											
										</form>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>						
											<button onclick="event.preventDefault();document.getElementById('create-form').submit();" class="btn btn-primary">Create</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							@if(sizeof($reservations)==0)
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
							@else
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
							@endif
							<form id="export-form" action="{{ url('reservation/export') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if (session('reservation_error')||session('customer_error')||session('route_error')||session('user_error')||session('date_error'))
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#createModal').modal('show');
	});
</script>
@endif
@endsection
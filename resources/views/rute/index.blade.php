@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Data Rute</div>

				<div class="panel-body">
					@if(sizeof($routes)==0)
					@else          
					<div class="table-responsive">						
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Depart At</th>                                    
									<th>Route From</th>
									<th>Route To</th>
									<th>Price</th>
									<th>Transportation ID</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($routes as $route)                            
								<tr>                                    
									<td>{{ $route->id }}</td>
									<td>{{ $route->depart_at }}</td>
									<td>{{ $route->route_from }}</td>
									<td>{{ $route->route_to }}</td>
									<td>{{ $route->price }}</td>
									<td>{{ $route->transportationid }}</td>
									<td><a href="{{ url('route')}}/{{ $route->id }}/show" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<b>View</b></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif					     
					<div class="row">
						<div class="col-md-6">                            
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal" style="width: 100%;">Tambah Rute</button>

							<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Tambah Rute</h4>
										</div>
										<form method="POST" action="{{ url('route/create') }}">
											<div class="modal-body">                                                
												{{ csrf_field() }}
												<div class="form-group{{ $errors->has('depart_at') ? ' has-error' : '' }}">
													<label for="depart_at" class="control-label">Depart At</label>

													<input id="depart_at" type="text" class="form-control" name="depart_at" value="{{ old('depart_at') }}" required autofocus>

													@if ($errors->has('depart_at'))
													<span class="help-block">
														<strong>{{ $errors->first('depart_at') }}</strong>
													</span>
													@endif                            
												</div>

												<div class="form-group{{ $errors->has('route_from') ? ' has-error' : '' }}">
													<label for="route_from" class="control-label">Route From</label>

													<input id="route_from" type="text" class="form-control" name="route_from" value="{{ old('route_from') }}" required autofocus>

													@if ($errors->has('route_from'))
													<span class="help-block">
														<strong>{{ $errors->first('route_from') }}</strong>
													</span>
													@endif                                            
												</div>

												<div class="form-group{{ $errors->has('route_to') ? ' has-error' : '' }}">
													<label for="route_to" class="control-label">Route To</label>

													<input id="route_to" type="text" class="form-control" name="route_to" value="{{ old('route_to') }}" required autofocus>

													@if ($errors->has('route_to'))
													<span class="help-block">
														<strong>{{ $errors->first('route_to') }}</strong>
													</span>
													@endif                                            
												</div>

												<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
													<label for="price" class="control-label">Price</label>

													<input type="number" min="1" max="999999999" class="form-control" name="price" id="price" value="{{ old('price') }}" autofocus required>

													@if ($errors->has('price'))
													<span class="help-block">
														<strong>{{ $errors->first('price') }}</strong>
													</span>
													@endif                                            
												</div>                   

												<div class="form-group{{ $errors->has('transportationid') ? ' has-error' : '' }}">
													<label for="transportationid" class="control-label">Transportation ID</label>

													<input type="number" class="form-control" name="transportationid" list="listid" 
													id="transportationid" value="{{ old('transportationid') }}" autofocus required>
													<datalist id="listid">
														@foreach($transportations as $transportation)
														<option value="{{ $transportation->id }}">{{$transportation->code}} - {{$transportation->description}}</option>
														@endforeach
													</datalist>

													@if (session('transportation_error'))
													<span class="help-block">	
														<strong>{{ session('transportation_error') }}</strong>
													</span>
													@endif

													@if ($errors->has('transportationid'))
													<span class="help-block">
														<strong>{{ $errors->first('transportationid') }}</strong>
													</span>
													@endif                                            
												</div>                   

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>                                    
												<button type="submit" class="btn btn-primary">Create</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							@if(sizeof($routes)==0)
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
							@else
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
							@endif
							<form id="export-form" action="{{ url('route/export') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if (session('transportation_error'))
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#createModal').modal('show');
	});
</script>
@endif
@endsection
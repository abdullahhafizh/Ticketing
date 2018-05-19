@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Data Transportation</div>

				<div class="panel-body">                    
					<div class="table-responsive">
						@if(sizeof($transportations)==0)
						@else
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Code</th>
									<th>Description</th>                                    
									<th>Seat Qty</th>
									<th>Transportation Type ID</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($transportations as $transportation)                            
								<tr>                                    
									<td>{{ $transportation->code }}</td>
									<td>{{ $transportation->description }}</td>
									<td>{{ $transportation->seat_qty }}</td>
									<td>{{ $transportation->transportation_typeid }}</td>
									<td><a href="{{ url('transportation')}}/{{ $transportation->id }}/show" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<b>View</b></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>                        
						@endif
					</div>                    
					<div class="row">
						<div class="col-md-6">							

							<button type="button" id="buttonCreateModal" class="btn btn-success" data-toggle="modal" data-target="#createModal" style="width: 100%;">Tambah Transportation</button>

							<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Tambah Transportation</h4>
										</div>
										<form method="POST" action="{{ url('transportation/create') }}">
											<div class="modal-body">                                                
												{{ csrf_field() }}												

												<!-- <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
													<label for="description" class="control-label">Description</label>

													<textarea id="description" class="form-control" name="description" required>{{ old('description') }}</textarea>

													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
													@endif                                            
												</div> -->

												<div class="form-group{{ $errors->has('seat_qty') ? ' has-error' : '' }}">
													<label for="seat_qty" class="control-label">Seat Qty</label>

													<input id="seat_qty" type="number" class="form-control" name="seat_qty" value="{{ old('seat_qty') }}" required autofocus>

													@if ($errors->has('seat_qty'))
													<span class="help-block">
														<strong>{{ $errors->first('seat_qty') }}</strong>
													</span>
													@endif                                            
												</div>

												<div class="form-group{{ $errors->has('transportation_typeid') ? ' has-error' : '' }}">
													<label for="transportation_typeid" class="control-label">Transportation Type ID</label>

													<input type="number" class="form-control" name="transportation_typeid" list="listid" 
													id="transportation_typeid" value="{{ old('transportation_typeid') }}" autofocus required>
													<datalist id="listid">
														@foreach($transport_type as $transtype)
														<option value="{{ $transtype->id }}">{{$transtype->description}}</option>
														@endforeach
													</datalist>

													@if ($errors->has('transportation_typeid'))
													<span class="help-block">
														<strong>{{ $errors->first('transportation_typeid') }}</strong>
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
							@if(sizeof($transportations)==0)
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
							@else
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
							@endif
							<form id="export-form" action="{{ url('transportation/export') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if (session('code_error'))
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#createModal').modal('show');
	});
</script>
@endif
@endsection
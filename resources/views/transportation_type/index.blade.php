@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Data Customer</div>

				<div class="panel-body">                    
					<div class="table-responsive">
						@if(sizeof($transport_type)==0)
						@else
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Description</th>                                    
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($transport_type as $transtyp)                            
								<tr>                                    
									<td>{{ $transtyp->id }}</td>
									<td>{{ $transtyp->description }}</td>                                    
									<td><a href="{{ url('transportation_type')}}/{{ $transtyp->id }}/show" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<b>View</b></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>                        
						@endif
					</div>                    
					<div class="row">
						<div class="col-md-6">                            
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal" style="width: 100%;">Tambah Transportation Type</button>

							<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Tambah Transportation Type</h4>
										</div>
										<form method="POST" action="{{ url('transportation_type/create') }}">
											<div class="modal-body">                                                
												{{ csrf_field() }}
												<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
													<label for="description" class="control-label">Description</label>

													<textarea id="description" class="form-control" name="description" required="">{{ old('description') }}</textarea>

													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
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
							@if(sizeof($transport_type)==0)
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
							@else
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
							@endif
							<form id="export-form" action="{{ url('transportation_type/export') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
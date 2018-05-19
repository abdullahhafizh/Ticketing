@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Data User</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<a href="{{ route('register') }}" class="btn btn-success" style="width: 100%;">Tambah User</a>
						</div>
						<div class="col-md-6">
							@if(sizeof($users)==0)
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
							@else
							<a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
							@endif
							<form id="export-form" action="{{ url('users/export') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
					<br>
					<div class="table-responsive">
						@if(sizeof($users)==0)
						@else
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Username</th>
									<th>Fullname</th>
									<th>Level</th>
									<th>Created At</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)                            
								<tr>                                    
									<td>{{ $user->id }}</td>
									<td>{{ $user->username }}</td>
									<td>{{ $user->fullname }}</td>
									@if($user->level==1)
									<td>User</td>
									@elseif($user->level==2)
									<td>Admin</td>
									@endif									
									<td>{{ $user->created_at }}</td>
									<td>
										<div class="col-md-6">
											<a href="{{ url('users')}}/{{ $user->id }}/edit" class="btn btn-sm btn-success pull-left" style="width: 100%;"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<b>Edit</b></a>
										</div>
										<div class="col-md-6">
											<a onclick="event.preventDefault();document.getElementById('delete-form').submit();" class="btn btn-sm btn-danger pull-right" style="width: 100%;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<b>Hapus</b></a>											
											<form id="delete-form" action="{{ url('users') }}/{{$user->id}}/destroy" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>                        
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

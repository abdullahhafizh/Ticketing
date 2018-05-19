@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Pemesanan Berhasil</div>

				<div class="panel-body">
					@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
					@endif

					<a>Klik disini untuk mencetak struk</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

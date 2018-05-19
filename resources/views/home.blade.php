@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reservasi</div>

                <div class="panel-body">                    
                    <form class="form-horizontal" method="POST" action="{{ url('search') }}">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('route_from') ? ' has-error' : '' }}">
                                <label for="route_from" class="col-md-4 control-label">Rute Awal</label>

                                <div class="col-md-6">
                                    <select class="form-control">
                                        @foreach($routes as $route)                                    
                                        <option value="{{ $route->id }}">{{ $route->route_from }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input id="route_from" type="text" class="form-control" name="route_from" value="{{ old('route_from') }}" required autofocus> -->

                                    @if ($errors->has('route_from'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('route_from') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('route_to') ? ' has-error' : '' }}">
                                <label for="route_to" class="col-md-4 control-label">Rute Akhir</label>

                                <div class="col-md-6">
                                    <select class="form-control">
                                        @foreach($routes as $route)
                                        <option value="{{ $route->id }}">{{ $route->route_to }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input id="route_to" type="text" class="form-control" name="route_to" value="{{ old('route_to') }}" required autofocus> -->

                                    @if ($errors->has('route_to'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('route_to') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Cari 
                                    </button>
                                </div>
                            </div>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

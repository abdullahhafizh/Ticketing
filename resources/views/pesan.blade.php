@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reservasi</div>

                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2">
                        <form method="POST" action="{{ url('reservasi/create') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('customerid') ? ' has-error' : '' }}">
                                <label for="customerid" class="control-label">ID Pelanggan</label>
                                <small class="pull-right">Nama Pelanggan</small>

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
                            <div class="form-group{{ $errors->has('reservation_at') ? ' has-error' : '' }}">
                                <label for="reservation_at" class="control-label">Tempat Reservasi</label>

                                <input id="reservation_at" type="text" class="form-control" name="reservation_at" required autofocus>

                                @if ($errors->has('reservation_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reservation_at') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('reservation_date') ? ' has-error' : '' }}">
                                <label for="reservation_date" class="control-label">Tanggal Berangkat</label>

                                <input id="reservation_date" type="date" class="form-control" name="reservation_date" required autofocus>

                                @if ($errors->has('reservation_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reservation_date') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="pull-right">                                
                                    <input type="hidden" name="id" id="id" value="{{ $route }}" class="form-control">
                                    <button type="submit" class="btn btn-primary">
                                        Pesan
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

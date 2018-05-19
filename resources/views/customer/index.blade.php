@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Data Customer</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">                            
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal" style="width: 100%;">Tambah Customer</button>

                            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Tambah Customer</h4>
                                </div>
                                <form method="POST" action="{{ url('customer/create') }}">
                                    <div class="modal-body">                                                
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="control-label">Name</label>

                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif                            
                                        </div>

                                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label for="address" class="control-label">Address</label>
                                            
                                            <textarea id="address" class="form-control" name="address" required>{{ old('address') }}</textarea>

                                            @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif                                            
                                        </div>

                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone" class="control-label">Phone</label>
                                            
                                            <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                            @if (session('phone_error'))
                                            <span class="help-block">
                                                <strong>Nomor sudah terpakai</strong>
                                            </span>
                                            @endif

                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif                                            
                                        </div>

                                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label for="gender" class="control-label">Gender</label>

                                            <select class="form-control" data-toggle="dropdown" id="gender" name="gender" required>
                                                <option>Male</option>
                                                <option>Female</option>
                                                <option>Other</option>
                                            </select>

                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
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
                    @if(sizeof($customers)==0)
                    <a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
                    @else
                    <a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
                    @endif
                    <form id="export-form" action="{{ url('customer/export') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                @if(sizeof($customers)==0)
                @else
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)                            
                        <tr>
                            <td>{{ $customer->id }}</td>                                    
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td><a href="{{ url('customer')}}/{{ $customer->id }}/show" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<b>View</b></a></td>
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
@if (session('phone_error'))
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#createModal').modal('show');
    });
</script>
@endif
@endsection
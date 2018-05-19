@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Reservation</div>
                <div class="panel-body">                    
                    <div class="table-responsive">                        
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reservation Code</th>
                                    <th>Reservation At</th>
                                    <th>Reservation Date</th>
                                    <th>customer ID</th>
                                    <th>Seat Code</th>
                                    <th>Route ID</th>
                                    <th>Depart At</th>
                                    <th>Price</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody>                                                        
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
                                </tr>                                
                            </tbody>
                        </table>                        
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">                            
                            <a onclick="event.preventDefault();document.getElementById('edit-form').submit();" class="btn btn-primary" style="width: 100%;">Edit</a>
                            <form id="edit-form" action="{{ url('reservation') }}/{{ $reservation->id }}/edit" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <div class="col-md-6">                            
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" style="width: 100%;">
                              Delete
                          </button>
                          
                          <div class="modal fade bs-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Yakin Ingin Menghapus?</h4>
                                </div>
                                <div class="modal-body">
                                    Dengan mengklik Delete, anda setuju akan menghapus data...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a onclick="event.preventDefault();document.getElementById('delete-form').submit();" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="delete-form" action="{{ url('reservation') }}/{{ $reservation->id }}/destroy" method="POST" style="display: none;">
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
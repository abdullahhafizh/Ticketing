@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Data Transportation Type</div>
                <div class="panel-body">                    
                    <div class="table-responsive">                        
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>                                                        
                                <tr>                                    
                                    <td>{{ $transport_type->id }}</td>
                                    <td>{{ $transport_type->description }}</td>
                                </tr>                                
                            </tbody>
                        </table>                        
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">                            
                            <a onclick="event.preventDefault();document.getElementById('edit-form').submit();" class="btn btn-primary" style="width: 100%;">Edit</a>
                            <form id="edit-form" action="{{ url('transportation_type') }}/{{ $transport_type->id }}/edit" method="POST" style="display: none;">
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
                    <form id="delete-form" action="{{ url('transportation_type') }}/{{ $transport_type->id }}/destroy" method="POST" style="display: none;">
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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="">
                <div class="panel-heading"><legend>Silahkan Pilih Rute Yang Ingin Dituju</legend></div>

                <div class="panel-body">
                    @foreach($routes as $route)
                    <?php
                    $qty = \App\Transportation::where('id',$route->transportationid)->value('available_qty');
                    $transgettype = \App\Transportation::where('id',$route->transportationid)->value('transportation_typeid');
                    $transtype = \App\TransportationType::where('id', '=', $transgettype)->value('description');
                    ?>                        
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Rute dari {{ $route->route_from }} ke {{ $route->route_to }}</div>
                            <form action="{{url('pesan')}}" method="POST">
                                {{csrf_field()}}
                                <div class="panel-body">                                
                                    <h5>ID Rute : {{$route->id}}</h5>                            
                                    <h5>Harga : {{$route->price}}</h5>
                                    <h5>Kursi yang tersedia : {{ $qty }}</h5>
                                    <h5>Tipe : {{ $transtype }}</h5>
                                </div>
                                <div class="panel-footer panel-primary">
                                    <input type="hidden" value="{{$route->id}}" name="routeid">
                                    <button class="btn btn-secondary btn-lg" style="width: 100%;" type="submit">Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

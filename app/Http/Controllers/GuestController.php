<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Reservation;
use \App\Route;
use \App\Transportation;
use \App\Customer;
use Auth;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function store(Request $request)
    {
        if (!Customer::where('id', '=', $request->input('customerid'))->exists() && !Route::where('id', '=', $request->input('routeid'))->exists()) {
            return back()->with('customer_error', 'ID '.$request->input('customerid').' tidak ditemukan')->with('route_error', 'ID '.$request->input('routeid').' tidak ditemukan');
        }
        if (!Customer::where('id', '=', $request->input('customerid'))->exists()) {
            return back()->with('customer_error', 'ID '.$request->input('customerid').' tidak ditemukan');
        }
        if (!Route::where('id', '=', $request->input('routeid'))->exists()) {
            return back()->with('route_error', 'ID '.$request->input('routeid').' tidak ditemukan');
        }

        $transid = Route::where('id', '=', $request->input('routeid'))->value('transportationid');
        $available_qty = Transportation::where('id', '=', $transid)->value('available_qty');

        if (!$available_qty<1) {
            $table = new Reservation;
            $table->reservation_code = uniqid();
            $table->reservation_at = $request->input('reservation_at');        
            $table->reservation_date = date("YmdHis");
            $table->customerid = $request->input('customerid');

            $depart_at = Route::find($request->input('routeid'))->value('depart_at');                    
            $seat_qty = Transportation::where('id', '=', $transid)->value('seat_qty');        

            $current_qty = $available_qty - 1;

            $code = $transid.'-'.($seat_qty - $current_qty);

            $table->seat_code = $code;
            $table->routeid = $request->input('routeid');
            $table->depart_at = $depart_at;        

            $price = Route::where('id', $request->input('routeid'))->value('price');
            $table->price = $price;

            $table->userid = Auth::user()->id;
            $table->save();

            $trans = Transportation::find($transid);
            $trans->available_qty = $current_qty;
            $trans->save();

            return redirect(url('home'));
        }

        return redirect(url('home'))->with('route_error', 'Pemesanan Rute Sudah Penuh! Silahkan Pilih Rute Yang Lain..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $route_from = $request->input('route_from');
        $route_to = $request->input('route_to');
        $data['routes'] = Route::where('route_from','like','%'.$route_from.'%','AND','route_to','like','%'.$route_to.'%')->get();

        return view('reservation')->with($data);
    }

    public function pesan(Request $request) 
    {
        $routeid = $request->input('routeid');        

        return redirect(url('new/pesan/'.$routeid));
    }

    public function newpesan($id)
    {
        $data['route'] = $id;
        $data['customers'] = Customer::get();

        return view('pesan')->with($data);
    }

    public function reservasi_create(Request $request)
    {   
        $transid = Route::where('id', '=', $request->input('id'))->value('transportationid');
        $available_qty = Transportation::where('id', '=', $transid)->value('available_qty');

        $table = new Reservation;
        $table->reservation_code = uniqid();
        $table->routeid = $request->input('id');        
        $table->reservation_at = $request->input('reservation_at');
        $table->reservation_date = $request->input('reservation_date');
        $table->customerid = $request->input('customerid');

        $depart_at = Route::find($request->input('id'))->value('depart_at');                    
        $seat_qty = Transportation::where('id', '=', $transid)->value('seat_qty');        

        $current_qty = $available_qty - 1;

        $code = $transid.'-'.($seat_qty - $current_qty);

        $table->seat_code = $code;
        $table->routeid = $request->input('id');
        $table->depart_at = $depart_at;        

        $price = Route::where('id', $request->input('id'))->value('price');
        $table->price = $price;

        $table->userid = Auth::user()->id;
        $table->save();

        $trans = Transportation::find($transid);
        $trans->available_qty = $current_qty;
        $trans->save();        

        return redirect(url('success'));
    }

    public function success()
    {
        return view('success');
    }

    // public function search(Request $request)
    // {
    //     $depart_at = $request->input('depart_at');
    //     $depart_to = $request->input('depart_to');
    //     $route = Route::where('route_from','like','%'.$depart_at.'%','AND','route_to','like','%'.$depart_to.'%')->orderBy('id','asc')->paginate(20);

    //     return view('reservation')->with('data', $route)->with('depart_at', $depart_at)->with('depart_to',$depart_to);
    // }

    // public function pesan(Request $request) 
    // {
    //     $routeid = $request->input('routeid');
    //     $routetrans = Route::where('id',$routeid)->value('transportationid');

    //     $a = new Reservation;
    //     $a->reservation_code = uniqid();
    //     $a->routeid = $routeid;        
    //     $a->save();

    //     return redirect(url('new/pesan/'.$routetrans));
    // }

    // public function newpesan($id){
    //     $a = Transportation::find($id);
    //     $q = Customer::all();
    //     return view('pesan')->with('customers',$q)->with('trans',$a);
    // }

    // public function reservasi_create(Request $request)
    // {        
    //     $table = Reservation::find($request->input('id'));
    //     $table->reservation_at = $request->input('reservation_at');
    //     $table->customerid = $request->input('customerid');
    //     $table->reservation_date = $request->input('reservation_date');       
    //     $table->save();

    //     return redirect(url('pesan'));
    // }
}

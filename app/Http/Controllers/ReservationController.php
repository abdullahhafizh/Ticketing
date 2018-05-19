<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Reservation;
use \App\Customer;
use \App\Route;
use \App\User;
use Auth;
use Excel;

class ReservationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['reservations'] = Reservation::get();
        $data['customers'] = Customer::get();
        $data['routes'] = Route::get();
        $data['users'] = User::get();
        return view('reservation.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        if (!Customer::where('id', '=', $request->input('customerid'))->exists() && !Route::where('id', '=', $request->input('routeid'))->exists() && !User::where('id', '=', $request->input('userid'))->exists() && Reservation::where('reservation_code', '=', $request->input('reservation_code'))->exists()) {
            return back()->with('customer_error', 'ID '.$request->input('customerid').' tidak ditemukan')->with('route_error', 'ID '.$request->input('routeid').' tidak ditemukan')->with('user_error', 'ID '.$request->input('userid').' tidak ditemukan')->with('reservation_error', 'Code reservasi '.$request->input('reservation_code').' sudah terdaftar');
        }
        // if ($request->input('reservation_date')==null) {
        //     return back()->with('date_error', 'Tanggal belum diisi');
        // }
        if (Reservation::where('reservation_code', '=', $request->input('reservation_code'))->exists()) {
            return back()->with('reservation_error', 'Code reservasi '.$request->input('reservation_code').' sudah terdaftar');
        }
        if (!Customer::where('id', '=', $request->input('customerid'))->exists()) {
            return back()->with('customer_error', 'ID '.$request->input('customerid').' tidak ditemukan');
        }
        if (!Route::where('id', '=', $request->input('routeid'))->exists()) {
            return back()->with('route_error', 'ID '.$request->input('routeid').' tidak ditemukan');
        }
        // if (!User::where('id', '=', $request->input('userid'))->exists()) {
        //     return back()->with('user_error', 'ID '.$request->input('userid').' tidak ditemukan');
        // }
        $table = new Reservation;
        $table->reservation_code = uniqid();
        $table->reservation_at = $request->input('reservation_at');
        $table->reservation_date = date('d/m/y');
        $table->customerid = $request->input('customerid');
        $table->seat_code = $request->input('seat_code');
        $table->routeid = $request->input('routeid');
        $table->depart_at = $request->input('depart_at');

        $route = Route::find($request->input('routeid'));
        $table->price = $route->price;


        $table->userid = Auth::user()->id;
        $table->save();

        return redirect(url('reservation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['reservation'] = Reservation::find($id);
        return view('reservation.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['reservation'] = Reservation::find($id);
        $data['customers'] = Customer::get();
        $data['routes'] = Route::get();
        $data['users'] = User::get();
        return view('reservation.edit')->with($data);
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
        if (!$request->input('reservation_code')==null && !$request->input('customerid')==null && !$request->input('routeid')==null && !$request->input('userid')==null) {
            if (Reservation::where('reservation_code', '=', $request->input('reservation_code'))->exists() && !Customer::where('id', '=', $request->input('customerid'))->exists() && !Route::where('id', '=', $request->input('routeid'))->exists() && !User::where('id', '=', $request->input('userid'))->exists()) {
                return back()->with('reservation_error', 'Code '.$request->input('reservation_code').' sudah terdaftar')->with('customer_error', 'ID '.$request->input('customerid').' tidak ditemukan')->with('route_error', 'ID '.$request->input('routeid').' tidak ditemukan')->with('user_error', 'ID '.$request->input('userid').' tidak ditemukan');
            }
        }
        if (!$request->input('reservation_code')==null) {
            if (Reservation::where('reservation_code', '=', $request->input('reservation_code'))->exists()) {
                return back()->with('reservation_error', 'Code '.$request->input('reservation_code').' sudah terdaftar');
            }
        }
        if (!$request->input('customerid')==null) {
            if (!Customer::where('id', '=', $request->input('customerid'))->exists()) {
                return back()->with('customer_error', 'ID '.$request->input('customerid').' tidak ditemukan');
            }
        }
        if (!$request->input('routeid')==null) {
            if (!Route::where('id', '=', $request->input('routeid'))->exists()) {
                return back()->with('route_error', 'ID '.$request->input('routeid').' tidak ditemukan');
            }
        }
        if (!$request->input('userid')==null) {
            if (!User::where('id', '=', $request->input('userid'))->exists()) {
                return back()->with('user_error', 'ID '.$request->input('userid').' tidak ditemukan');
            }
        }
        $table = Reservation::find($id);
        if (!$request->input('reservation_code')==null) {
            $table->reservation_code = $request->input('reservation_code');
        }        
        $table->reservation_at = $request->input('reservation_at');
        $table->reservation_date = $request->input('reservation_date');
        if (!$request->input('customerid')==null) {
            $table->customerid = $request->input('customerid');
        }
        $table->seat_code = $request->input('seat_code');
        if (!$request->input('routeid')==null) {
            $table->routeid = $request->input('routeid');
            $route = Route::find($request->input('routeid'));
            $table->price = $route->price;
        }
        $table->depart_at = $request->input('depart_at');        
        if (!$request->input('userid')==null) {
            $table->userid = $request->input('userid');
        }
        $table->save();

        return redirect(url('reservation/'.$id.'/show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Reservation::find($id);
        $table->delete();

        return redirect(url('reservation'));
    }

    public function export()
    {
        if (!$result = Reservation::get()->isEmpty()) {
            Excel::create("Data-Reservation" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $reservations = Reservation::all();
                    foreach($reservations as $reservation){
                        $data=[];
                        array_push($data, array(
                            $reservation->id,
                            $reservation->reservation_code,
                            $reservation->reservation_at,
                            $reservation->reservation_date,
                            $reservation->customerid,
                            $reservation->seat_code,
                            $reservation->routeid,
                            $reservation->depart_at,
                            $reservation->price,
                            $reservation->userid
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('ID','Reservation Code', 'Reservation At', 'Reservation Date', 'Customer ID', 'Seat Code', 'Route ID', 'Depart At', 'Price', 'User ID'));
                    $sheet->setBorder('A1:B1', 'thin');
                    $sheet->setBorder('C1:D1', 'thin');
                    $sheet->setBorder('E1:F1', 'thin');
                    $sheet->setBorder('G1:H1', 'thin');
                    $sheet->setBorder('I1:J1', 'thin');
                    $sheet->cells('A1:B1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('C1:D1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('E1:F1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('G1:H1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->cells('I1:J1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->setHeight(array(
                        '1' => '20'
                    ));
                    $sheet->setWidth('A', '15');
                    $sheet->setWidth('B', '15');
                    $sheet->setWidth('C', '25');
                    $sheet->setWidth('D', '15');
                    $sheet->setWidth('E', '15');
                    $sheet->setWidth('F', '15');
                    $sheet->setWidth('G', '15');
                    $sheet->setWidth('H', '25');
                    $sheet->setWidth('I', '15');
                    $sheet->setWidth('J', '15');
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());
    }
}

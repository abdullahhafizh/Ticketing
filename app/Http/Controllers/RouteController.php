<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Route;
use \App\Transportation;
use Excel;

class RouteController extends Controller
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

        $data['routes'] = Route::get();
        $data['transportations'] = Transportation::get();       
        return view('rute.index')->with($data);
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
        if (Transportation::where('id', '=', $request->input('transportationid'))->exists()) {
            $table = new Route;
            $table->depart_at = $request->input('depart_at');
            $table->route_from = $request->input('route_from');
            $table->route_to = $request->input('route_to');
            $table->price = $request->input('price');
            $table->transportationid = $request->input('transportationid');
            $table->save();

            return redirect(url('route'));
        }

        return back()->with('transportation_error', 'ID '.$request->input('transportationid').' tidak ditemukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['route'] = Route::find($id);
        return view('rute.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['route'] = Route::find($id);
        $data['transportations'] = Transportation::get();            
        return view('rute.edit')->with($data);
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
        $table = Route::find($id);
        $table->depart_at = $request->input('depart_at');
        $table->route_from = $request->input('route_from');
        $table->route_to = $request->input('route_to');
        $table->price = $request->input('price');            
        if (!$request->input('transportationid')==null) {
            if (Transportation::where('id', '=', $request->input('transportationid'))->exists()) {
                $table->transportationid = $request->input('transportationid');
            }
            else
            {
                return back()->with('transportationid_error', 'ID '.$request->input('transportationid').' tidak ditemukan');
            }
        }            
        $table->save();

        return redirect(url('route/'.$id.'/show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Route::find($id);
        $table->delete();

        return redirect(url('route'));
    }

    public function export()
    {
        if (!$result = Route::get()->isEmpty()) {
            Excel::create("Data-Rute" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $routes = Route::all();
                    foreach($routes as $route){
                        $data=[];
                        array_push($data, array(
                            $route->id,
                            $route->depart_at,
                            $route->route_from,
                            $route->route_to,
                            $route->price,
                            $route->transportationid
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('ID','Depart At', 'Route From', 'Route To', 'Price', 'Transportation ID'));
                    $sheet->setBorder('A1:B1', 'thin');
                    $sheet->setBorder('C1:D1', 'thin');
                    $sheet->setBorder('E1:F1', 'thin');
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
                    $sheet->setHeight(array(
                        '1' => '20'
                    ));
                    $sheet->setWidth('A', '15');
                    $sheet->setWidth('B', '15');
                    $sheet->setWidth('C', '15');
                    $sheet->setWidth('D', '15');
                    $sheet->setWidth('E', '15');
                    $sheet->setWidth('F', '15');
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());
    }
}

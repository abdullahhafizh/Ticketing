<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\TransportationType;
use \App\Transportation;
use Excel;

class TransportationController extends Controller
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
        $data['transportations'] = Transportation::get();
        $data['transport_type'] = TransportationType::get();
        return view('transportation.index')->with($data);
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
        if (Transportation::where('code', '=', $request->input('code'))->exists()) {
            return back()->with('code_error', 'Error');            
        }
        $transtypedesc = TransportationType::find($request->input('transportation_typeid'));

        $table = new Transportation;
        // $table->code = $request->input('code');
        $table->code = uniqid();
        $table->description = $transtypedesc->description;
        $table->seat_qty = $request->input('seat_qty');
        $table->transportation_typeid = $request->input('transportation_typeid');
        $table->save();

        return redirect(url('transportation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['transportation'] = Transportation::find($id);
        return view('transportation.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['transportation'] = Transportation::find($id);
        $data['transport_type'] = TransportationType::get();
        return view('transportation.edit')->with($data);
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
        if (!TransportationType::where('id', '=', $request->input('transportation_typeid'))->exists() && Transportation::where('code', '=', $request->input('code'))->exists()) {
            return back()->with('code_error', 'Code '.$request->input('code').' sudah terdaftar')->with('transtypeid_error', 'ID '.$request->input('transportation_typeid').' tidak ditemukan');
        }
        else
        {            
            if (Transportation::where('code', '=', $request->input('code'))->exists()) {
                return back()->with('code_error', 'Code '.$request->input('code').' sudah terdaftar');
            }
            else
            {
                if (!$request->input('transportation_typeid')==null) {
                    if (TransportationType::where('id', '=', $request->input('transportation_typeid'))->exists()) {
                        $transtypedesc = TransportationType::find($request->input('transportation_typeid'));

                        $table = Transportation::find($id);
                        $table->code = $request->input('code');
                        $table->description = $transtypedesc->description;
                        $table->seat_qty = $request->input('seat_qty');                    
                        $table->transportation_typeid = $request->input('transportation_typeid');                    
                        $table->save();
                    }
                    else
                    {
                        return back()->with('transtypeid_error', 'ID '.$request->input('transportation_typeid').' tidak ditemukan');
                    }
                }
                else
                {
                    $table = Transportation::find($id);
                    $table->code = $request->input('code');                    
                    $table->seat_qty = $request->input('seat_qty');
                    
                    $table->save();
                }
            }

            return redirect(url('transportation/'.$id.'/show'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Transportation::find($id);
        $table->delete();

        return redirect(url('transportation'));
    }

    public function export()
    {
        if (!$result = Transportation::get()->isEmpty()) {
            Excel::create("Data-Transportation_" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $transportations = Transportation::all();
                    foreach($transportations as $transportation){
                        $data=[];
                        array_push($data, array(
                            $transportation->id,
                            $transportation->code,
                            $transportation->description,
                            $transportation->seat_qty,
                            $transportation->transportation_typeid
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('ID','Code', 'Description', 'Seat Qty', 'Transportation Type ID'));
                    $sheet->setBorder('A1:B1', 'thin');
                    $sheet->setBorder('C1:D1', 'thin');
                    $sheet->setBorder('E1', 'thin');
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
                    $sheet->cells('E1', function($cells){
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
                    $sheet->setWidth('E', '20');
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());
    }
}

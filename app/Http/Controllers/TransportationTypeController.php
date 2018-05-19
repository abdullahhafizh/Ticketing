<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\TransportationType;
use Excel;

class TransportationTypeController extends Controller
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
        $data['transport_type'] = TransportationType::get();
        return view('transportation_type.index')->with($data);
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
        $table = new TransportationType;
        $table->description = $request->input('description');        
        $table->save();

        return redirect(url('transportation_type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['transport_type'] = TransportationType::find($id);
        return view('transportation_type.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['transport_type'] = TransportationType::find($id);
        return view('transportation_type.edit')->with($data);
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
        $table = TransportationType::find($id);
        $table->description = $request->input('description');        
        $table->save();

        return redirect(url('transportation_type/'.$id.'/show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = TransportationType::find($id);
        $table->delete();

        return redirect(url('transportation_type'));
    }

    public function export()
    {
        if (!$result = TransportationType::get()->isEmpty()) {
            Excel::create("Data-Transportation-Type_" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $transporttype = TransportationType::all();
                    foreach($transporttype as $transtype){
                        $data=[];
                        array_push($data, array(
                            $transtype->id,
                            $transtype->description
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('ID','Description'));
                    $sheet->setBorder('A1:B1', 'thin');                    
                    $sheet->cells('A1:B1', function($cells){
                        $cells->setBackground('#2ab27b');
                        $cells->setFontColor('#ffffff');
                        $cells->setValignment('center');
                        $cells->setFontSize('11');
                    });
                    $sheet->setHeight(array(
                        '1' => '20'
                    ));
                    $sheet->setWidth('A', '15');
                    $sheet->setWidth('B', '25');                    
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());
    }
}

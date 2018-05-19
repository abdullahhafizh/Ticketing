<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Customer;
use Excel;

class CustomerController extends Controller
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
        $data['customers'] = Customer::get();
        return view('customer.index')->with($data);
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
        if (Customer::where('phone', '=', $request->input('phone'))->exists()) {
            return back()->with('phone_error', 'Error');            
        }        
        $table = new Customer;
        $table->name = $request->input('name');
        $table->address = $request->input('address');            
        $table->phone = $request->input('phone');            
        $table->gender = $request->input('gender');        
        $table->save();

        return redirect(url('customer'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['customer'] = Customer::find($id);
        return view('customer.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['customer'] = Customer::find($id);
        return view('customer.edit')->with($data);
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
        $table = Customer::find($id);
        $table->name = $request->input('name');
        $table->address = $request->input('address');
        $table->phone = $request->input('phone');
        $table->gender = $request->input('gender');        
        $table->save();

        return redirect(url('customer/'.$id.'/show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Customer::find($id);
        $table->delete();

        return redirect(url('customer'));
    }

    public function export()
    {
        if (!$result = Customer::get()->isEmpty()) {
            Excel::create("Data-Customer_" . date('dmyH'), function($result)
            {
                $result->sheet('SheetName', function($sheet)
                {
                    $customers = Customer::all();
                    foreach($customers as $customer){
                        $data=[];
                        array_push($data, array(
                            $customer->id,
                            $customer->name,
                            $customer->address,
                            $customer->phone,
                            $customer->gender
                        ));
                        $sheet->fromArray($data, null, 'A2', false, false);
                    }
                    $sheet->row(1, array('ID','Name','Address','Phone','Gender'));
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
                    $sheet->setWidth('A', '20');
                    $sheet->setWidth('B', '20');
                    $sheet->setWidth('C', '25');
                    $sheet->setWidth('D', '15');
                    $sheet->setWidth('E', '10');
                });                    
                return redirect(url()->previous());
            })->download('xls');
        }
        return redirect(url()->previous());

    }
}

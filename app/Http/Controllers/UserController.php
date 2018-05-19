<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Hash;

class UserController extends Controller
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
        $data['users'] = User::get();
        return view('user.index')->with($data);
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
        //
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
        $data['user'] = User::find($id);
        return view('user.edit')->with($data);
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
        $user = User::find($id);
        if (!$request->get('current-password')==null && !$request->get('new-password')==null) {
            if (!(Hash::check($request->get('current-password'), $user->password))) {
            // Password lama salah
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }

            if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Password lama dan baru sama
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            }

            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]);

        //Password baru
            $user->password = bcrypt($request->get('new-password'));
        }        
        $user->fullname = $request->get('fullname');
        $user->level = $request->get('level');
        $user->save();

        return redirect(url('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = User::find($id);
        $table->delete();

        return redirect(url('users'));
    }
}

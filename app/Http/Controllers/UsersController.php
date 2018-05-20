<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Roles;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::all();
       // dd($users[0]);
       return view('auth.users')->with('users', User::all());
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

    /*
        add automatically to a admin role
    */
    public function removeAdminRights($id) {
        $user=User::find($id);
        $roleRegular = Roles::where('name', 'Reqular')->get()->first();
        $user->role_id=$roleRegular->id;
        $user->save();
        return redirect()->back();

    }

    public function giveAdminRights($id) {
        $user=User::find($id);
        $roleAdmin = Roles::where('name', 'Admin')->get()->first();
        $user->role_id=$roleAdmin->id;
        $user->save();
        return redirect()->back();
    }   
}

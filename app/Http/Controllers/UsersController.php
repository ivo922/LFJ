<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Support\Facades\DB; //Check if needed
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //Check if needed

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $allUsers = User::paginate(20);
            $user = Auth::user();
            return View('Users.index', ['allUsers' => $allUsers], ['user' => $user]);
        } else {
            return redirect('/');
        }
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
        if(Auth::check()){
            $user = User::Find($id);
            $companies = DB::table('companies')->where('userID', $user->id)->get();
            return View('Users.show', ['user' => $user], ['companies' => $companies]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){
            $user = User::find($id);
            if($user->id == Auth::user()->id){
                return View('Users.my_profile', ['user' => $user]);
            } elseif(Auth::user()->isAdmin == 1){
                return View('Users.edit', ['user' => $user]);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
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
        $user = User::find($id);
        $user->delete();
        return redirect('users');
    }

    /**
     * Ban the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ban($id)
    {
        if(Auth::check()){
            if(Auth::user()->isAdmin == 1){
                $user = User::find($id);
                if($user->isBanned == 0){
                $user->isBanned = 1;
                $user->save();
                } else {
                $user->isBanned = 0;
                $user->save();
                }
                return redirect('users');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}

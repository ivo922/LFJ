<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //Check if needed
use Illuminate\Support\Facades\Hash;

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
            if(Auth::user()->isAdmin == 1){
                $allUsers = User::paginate(20);
                $user = Auth::user();
                return View('Users.index', ['allUsers' => $allUsers], ['user' => $user]);
            } else {
                return redirect('/');
            }
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
            if(Auth::user()->isAdmin == 1){
                $user = User::Find($id);
                $companies = DB::table('companies')->where('userID', $user->id)->get();
                return View('Users.show', ['user' => $user], ['companies' => $companies]);
            } elseif(Auth::user()->id == $id) {
                return $this->myProfile();
                return View('Users.my_profile', ['user' => $user]);
            } else {
                return redirect('/');
            }
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
            if(Auth::user()->isAdmin == 1){
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
        $user = User::find($id);
        
        if(strlen(trim($request->get('name'))) != 0){
            $user->name = $request->get('name');
        }
        if(strlen(trim($request->get('email'))) != 0){
            $user->email = $request->get('email');
        }
        $user->isAdmin = $request->get('isAdmin');
        $user->save();
        return redirect()->action('UsersController@show', ['id' => $user->id]);
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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|confirmed|min:6|different:password'          
        ]);

        if (Hash::check($request->password, Auth::user()->password) == false)
        {
            return response(['message' => 'Unauthorized'], 401);  
        } 

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response(['message' => 'Your password has been updated successfully.']);
}

    public function myProfile(){
        if(Auth::check()){
            $user = Auth::user();
            $companies = Companies::where('userID', $user->id)->get();
            return View('Users.my_profile', ['user' => $user], ['companies' => $companies]);
        } else {
            return redirect('/');
        }
    }
}

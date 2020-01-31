<?php

namespace App\Http\Controllers;

use Auth;
use App\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class CompaniesController extends Controller
{
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
        if(Auth::check()){
            return View('Companies.create');
        } else {
            return redirect('auth/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('logo')->store('images', 'public');

        $rules = array('name' => 'required|unique:companies|min:3|max:32',
                    'logo' => 'required|image',
                    'description' => 'required|max:255|min:10', );
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect('companies/create')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $company = new Companies([
                'name' => $request->get('name'),
                'userID' => Auth::user()->id,
                'logo' => $path,
                'description' => $request->get('description')
            ]);
    
            $company->save();
            return redirect('companies/create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Companies::find($id);
        if($company != null){
            return View('Companies.show', ['company' => $company]);
        } else {
            abort(404);
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
        $company = Companies::findOrFail($id);

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
        $company = Companies::find($id);
        $company->delete();

        return redirect("/");
    }
}

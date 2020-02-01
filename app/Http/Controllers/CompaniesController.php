<?php

namespace App\Http\Controllers;

use Auth;
use App\Companies;
use App\Jobs;
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
        $companies = Companies::all();
        return View("Companies.index")->with('companies', $companies);
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
        $user = Auth::user();
        if(Auth::check()) {
            $isLoggedIn = 1;
        } else {
            $isLoggedIn = 0;
        }
        $company = Companies::findOrFail($id);
        $jobsByCompany = Jobs::where('company', $company->name)->get();
        $isJobsEmpty; //Checks if $jobsByCompany is empty
        if($jobsByCompany->isEmpty()){
            $isJobsEmpty = 1;
        }else{
            $isJobsEmpty = 0;
        }
        if($company != null){
            return View('Companies.show')->with('company', $company)
            ->with('jobs', $jobsByCompany)
            ->with('isJobsEmpty', $isJobsEmpty)
            ->with('user', $user)
            ->with('isLoggedIn', $isLoggedIn);
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
        return View('Companies.edit', ['company' => $company]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //Difficulty: 11/10 >:(
    {
        $company = Companies::findOrFail($id);

        if($request->logo == null){ //if no new image is uploaded, $path changes to the already existing one
            $path = $company->logo;
        } else {
            $rules = array('logo' => 'image', );
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return redirect('companies/' . $company->id . '/edit')
                ->withErrors($validator)
                ->withInput($request->all());
            } else {
                $path = $request->file('logo')->store('images', 'public');
            }
        }

        if($request->get('name') == null){ //if the name isn't updated, change it to the default one
            $requestData = $request->all(); //create a new array to store the modified data coming from the form
            $requestData['name'] = $company->name; //change the name value to the name stored in database
            $rules = array('description' => 'max:255|min:10', ); //validate only the description as the name isn't changed
            $validator = Validator::make($requestData, $rules); //pass the new array instead of $request->all()
            if($validator->fails()){
                return redirect('companies/' . $company->id . '/edit')
                ->withErrors($validator)
                ->withInput($requestData); //old: $request->all()
            } else {
                $company->name = $requestData['name'];
                $company->logo = $path;
                $company->description = $requestData['description'];
                $company->save();
                return redirect('companies/' . $company->id);
            } 
        } else {
            $rules = array('name' => 'unique:companies|min:3|max:32',
                'description' => 'max:255|min:10', );
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return redirect('companies/' . $company->id . '/edit')
                ->withErrors($validator)
                ->withInput($request->all());
            } else {
                $company->name = $request->get('name');
                $company->logo = $path;
                $company->description = $request->get('description');
                $company->save();
                return redirect('companies/' . $company->id);
            } 
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
        $company = Companies::find($id);
        $jobs = Jobs::where('company', $company->name)->get();
        foreach($jobs as $key => $value){
            $value->delete();
        }
        $company->delete();


        return redirect("/");
    }
}

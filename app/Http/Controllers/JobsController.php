<?php

namespace App\Http\Controllers;

use Auth;
use App\Jobs;
use App\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allJobs = DB::table('job_offers')->orderBy('created_at', 'desc')->paginate(10);
        return View('Jobs.index', ['allJobs' => $allJobs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $userid = Auth::user()->id;
            $companies = DB::table('companies')->where('userID', $userid)->pluck('name');
            return View('Jobs.create')->with('companies', $companies);
        } else {
            return redirect('login');
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
        $rules = array('position' => 'required',
                    'category' => 'required',
                    'place' => 'required',
                    'company' => 'required',
                    'type' => 'required',
                    'description' => 'required' );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect('jobs/create')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $companyName = $request->get('company');
            $company = Companies::where('name', $companyName)->first();
            $logo = $company->logo;
            $job = new Jobs([
                'position' => $request->get('position'),
                'category' => $request->get('category'),
                'place' => $request->get('place'),
                'company' => $request->get('company'),
                'type' => $request->get('type'),
                'description' => $request->get('description'),
                'logo' => $logo
            ]);

            $job->save();
            return redirect('/');
            print $logo; die;
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
        $job = Jobs::findOrFail($id);

        $created_at = $job -> created_at;
        $date = substr($created_at, 0, 10);
        
        return View('Jobs.show', ['job' => $job], ['date' => $date]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$user = Auth::user();
        $job = Jobs::findOrFail($id);
        $company = Companies::findOrFail(DB::table('companies')->where('name', $job->company)->pluck('id'));

        if(Auth::check()){
            if($user->isAdmin = true || $company->userID = $user->id) {
                return View('Jobs.edit', ['job' => $job]);
            } else{
                return redirect('/'); 
            }
        } else {
            return redirect('login');
        }*/
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
        $job = Jobs::find($id);
        $job->delete();

        return redirect('jobs')->with('success', 'Task was successful!');
    }
}

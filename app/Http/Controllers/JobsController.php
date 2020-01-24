<?php

namespace App\Http\Controllers;

use Auth;
use App\Jobs;
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
        $jobs = Jobs::all();
        return view('Jobs.index')->with('allJobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid = Auth::user()->id;
        $companies = DB::table('companies')->where('userID', $userid)->pluck('name');
        return View('Jobs.create')->with('companies', $companies);
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
                    'type' => 'required', );
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return redirect('jobs/create')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $job = new Jobs([
                'position' => $request->get('position'),
                'category' => $request->get('category'),
                'place' => $request->get('place'),
                'company' => $request->get('company'),
                'type' => $request->get('type')
            ]);

            $job->save();
            return redirect('/');
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
}

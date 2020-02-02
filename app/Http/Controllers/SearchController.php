<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs;
use App\Companies;
use App\User;

class SearchController extends Controller
{
    public function searchJobs(request $request) {
        $rules = array('searchField' => 'required|min:3|max:32', );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('jobs');
        } else {
            $searchItem = $request->searchField;
        $allJobs = Jobs::where('position', $searchItem)->get();
        return View('Jobs.index')->with('allJobs', $allJobs);
        }
    }

    public function searchUsers(request $request) {
        $rules = array('searchField' => 'required|min:3|max:32', );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('users');
        } else {
            $searchItem = $request->searchField;
            $allUsers = User::where('name', $searchItem)->get();
            return View('Users.index')->with('users', $allUsers);
        }
        
    }

    public function searchCompanies(request $request) {
        $rules = array('searchField' => 'required|min:3|max:32', );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('companies');
        } else {
            $searchItem = $request->searchField;
            $allCompanies = Companies::where('name', $searchItem)->get();
            return View('Companies.index')->with('companies', $allCompanies);
        }
        
    }
}

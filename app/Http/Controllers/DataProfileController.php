<?php

namespace App\Http\Controllers;

use DB;
use App\DataProfile;
use App\Imports\DataProfilesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class DataProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count =  DB::table('data_profile')->get()->count();
        return view('welcome')->with('dataProfiles', DB::table("data_profile")->paginate(25))
                            ->with('count', $count);
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
        $request->validate([
            'file' => 'required|mimes:xlx,xlsx,csv',
        ]);
        
        // dd('hello');
        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
         
        $this->import($fileName);

        return back()
            ->with('success','File imported Successfully!.');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function show(DataProfile $dataProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(DataProfile $dataProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataProfile $dataProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataProfile $dataProfile)
    {
        //
    }
    public function import($fileName) 
    {
        Excel::import(new DataProfilesImport, public_path('/uploads'.'/'.$fileName));
        

        \File::delete(public_path().'/uploads'.'/'.$fileName);
        
        // return redirect('/')->with('success', 'File Imported Successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = DB::table('jobs')
        ->whereNull('jobs.deleted_by')
        ->get();

        return view('jobs.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        try{
            DB::transaction(function () use($request){
                DB::table('jobs')->insert([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
              
            });
            
            return redirect('/job')->with(['success'=>'Data Berhasil Disimpan']);
            }catch(Exception $e){

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
        $job = DB::table('jobs')->where('id',$id)->get();
        return view('jobs.edit',compact('job'));
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
        $this->validate($request,[
            'name' => 'required'
        ]);

        try{
            DB::transaction(function () use($request, $id){
                DB::table('jobs')->where('id',$id)->update([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
              
            });
            
            return redirect('/job')->with(['success'=>'Data Berhasil Disimpan']);
            }catch(Exception $e){

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
        try{
            DB::transaction(function () use($id) {
                DB::table('candidates')->where('id',$id)->update([
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => 1
                ]);
            });
            return redirect()->back();
        }catch(Exception $e){

        }
    }
}

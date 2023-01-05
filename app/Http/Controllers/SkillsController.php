<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = DB::table('skills')
        ->whereNull('skills.deleted_by')
        ->get();

        return view('skills.index',compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skills.create');
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
                DB::table('skills')->insert([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
              
            });
            
            return redirect('/skills')->with(['success'=>'Data Berhasil Disimpan']);
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
        $skills = DB::table('skills')->where('id',$id)->get();
        return view('skills.edit',compact('skills'));
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
                DB::table('skills')->where('id',$id)->update([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
              
            });
            
            return redirect('/skills')->with(['success'=>'Data Berhasil Disimpan']);
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
                DB::table('skills')->where('id',$id)->update([
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => 1
                ]);
            });
            return redirect()->back();
        }catch(Exception $e){

        }
    }
}

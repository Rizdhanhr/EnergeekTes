<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
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
    
        return response()->json(['message' => 'Data Sukses Ditampilkan',"jobs" => $jobs], 200);
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
        $rules=array(
            'name' => 'required',
        );
        $messages=array(
            'name.required' => 'Masukkan Nama Pekerjaan!.',
        );
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            return response()->json(["messages"=>$messages], 500);
        }

        try{
            DB::transaction(function () use($request) {
                $jobs = DB::table('jobs')->insert([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
            });
            return response()->json(['message' => 'Data Berhasil Ditambahkan','jobs' => $jobs], 200);
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
        $jobs = DB::table('jobs')
        
        ->whereNull('candidates.deleted_by')
        ->where('jobs.id',$id)
        ->get();

        return response()->json(['message' => 'Data Sukses Ditampilkan',"jobs" => $jobs], 200);
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
        $rules=array(
            'name' => 'required',
        );
        $messages=array(
            'name.required' => 'Masukkan Nama Pekerjaan!.',
        );
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            return response()->json(["messages"=>$messages], 500);
        }

        try{
            DB::transaction(function () use($request,$id) {
                $jobs = DB::table('jobs')->where('jobs.id',$id)->update([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
            });
            return response()->json(['message' => 'Data Berhasil Diupdate','jobs' => $jobs], 200);
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
            DB::transaction(function () use($id){
                DB::table('jobs')->where('jobs.id',$id)->update([
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => 1
                ]);
            });
            return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
        }catch(Exception $e){}

    }
}

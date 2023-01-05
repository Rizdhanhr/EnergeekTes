<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        ->whereNull('jobs.deleted_by')
        ->get();
    
        return response()->json(['message' => 'Data Sukses Ditampilkan',"skills" => $skills], 200);
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
                $skills = DB::table('skills')->insert([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
            });
            return response()->json(['message' => 'Data Berhasil Ditambahkan','skills' => $skills], 200);
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
        $skills = DB::table('skills')
        
        ->whereNull('candidates.deleted_by')
        ->where('skills.id',$id)
        ->get();

        return response()->json(['message' => 'Data Sukses Ditampilkan',"skills" => $skills], 200);
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
                $skills = DB::table('skills')->where('skills.id',$id)->update([
                    'name' => $request->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
            });
            return response()->json(['message' => 'Data Berhasil Diupdate','skills' => $skills], 200);
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
                DB::table('skills')->where('skills.id',$id)->update([
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => 1
                ]);
            });
            return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
        }catch(Exception $e){}
    }
}

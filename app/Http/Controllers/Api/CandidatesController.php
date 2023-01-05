<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = DB::table('candidates')
        ->join('jobs','jobs.id','candidates.job_id')
        ->whereNull('candidates.deleted_by')
        ->get(array(
            'candidates.*','jobs.name as jobs_name'
        ));

        return response()->json(['message' => 'Data Sukses Ditampilkan',"candidates" => $candidates], 200);
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
            'job_id' => 'required|numeric',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|numeric|unique:candidates,phone',
            'year' => 'required|numeric',
            'skill' => 'required|numeric'
        );
        $messages=array(
            'name.required' => 'Masukkan Nama Kandidat!.',
            'email.unique' => 'Nama Email Tidak Boleh Sama!.',
            'email.email' => 'Format Harus Email!.',
            'email.required' => 'Masukkan Nama Email!.',
            'phone.required' => 'Masukkan No Hp!.',
            'phone.numeric' => 'No HP harus Angka!.',
            'phone.unique' => 'No HP Tidak Boleh Sama!.',
            'year.required' => 'Masukkan Tahun Lahir!.',
            'year.numeric' => 'Tahun harus angka!.',
            'job_id.numeric' => 'ID_Pekerjaan Harus Angka!.',
            'job_id.numeric' => 'Masukkan Pekerjaan!.',
            'job_id.numeric' => 'Masukkan Pekerjaan!.',
            'skill.numeric' => 'ID SKILL harus Angka!.',
            'skill.required' => 'Masukkan SKILL!.',
        );
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            return response()->json(["messages"=>$messages], 500);
        }
        try{
            DB::transaction(function () use($request){
                $candidates = DB::table('candidates')->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'job_id' => $request->job_id,
                    'phone' => $request->phone,
                    'year' => $request->year,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
                $skill = $request->skill;
                $id = DB::table('candidates')->max('id');
                foreach ((array ($skill)) as $key=>$value){
                    DB::table('skill_sets')->insert([
                        'candidates_id' => $id,
                        'skill_id' => $value
                    ]); 
                }
            });
            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 200);
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
        $candidates = DB::table('candidates')
        ->join('jobs','jobs.id','candidates.job_id')
        ->whereNull('candidates.deleted_by')
        ->where('candidates.id',$id)
        ->get(array(
            'candidates.*','jobs.name as jobs_name'
        ));

        return response()->json(['message' => 'Data Sukses Ditampilkan',"candidates" => $candidates], 200);
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
            'job_id' => 'required|numeric',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|numeric|unique:candidates,phone',
            'year' => 'required|numeric',
            'skill' => 'required|numeric'
        );
        $messages=array(
            'name.required' => 'Masukkan Nama Kandidat!.',
            'email.unique' => 'Nama Email Tidak Boleh Sama!.',
            'email.email' => 'Format Harus Email!.',
            'email.required' => 'Masukkan Nama Email!.',
            'phone.required' => 'Masukkan No Hp!.',
            'phone.numeric' => 'No HP harus Angka!.',
            'phone.unique' => 'No HP Tidak Boleh Sama!.',
            'year.required' => 'Masukkan Tahun Lahir!.',
            'year.numeric' => 'Tahun harus angka!.',
            'job_id.numeric' => 'ID_Pekerjaan Harus Angka!.',
            'job_id.numeric' => 'Masukkan Pekerjaan!.',
            'job_id.numeric' => 'Masukkan Pekerjaan!.',
            'skill.numeric' => 'ID SKILL harus Angka!.',
            'skill.required' => 'Masukkan SKILL!.',
        );
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            return response()->json(["messages"=>$messages], 500);
        }
        try{
            DB::transaction(function () use($request, $id){
                $candidates = DB::table('candidates')->where('candidates.id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'job_id' => $request->job_id,
                    'phone' => $request->phone,
                    'year' => $request->year,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
                DB::table('skill_sets')->where('candidates_id',$id)->delete();
                $skill = $request->skill;
                foreach ((array ($skill)) as $key=>$value){
                    DB::table('skill_sets')->insert([
                        'candidates_id' => $id,
                        'skill_id' => $value
                    ]); 
                }
            });
            return response()->json(['message' => 'Data Berhasil Diupdate'], 200);
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
                DB::table('skill_sets')->where('candidates_id',$id)->delete();
            });
            return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
        }catch(Exception $e){

        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

        return view('candidates.index',compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = DB::table('jobs')->get();
        $skills = DB::table('skills')->get();
        return view('candidates.create',compact('skills','jobs'));
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
            'name' => 'required',
            'job' => 'required|numeric',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|numeric|unique:candidates,phone',
            'year' => 'required|numeric',
            'skill' => 'required|numeric'
        ]);
        try{
            DB::transaction(function () use($request){
  
                $skill = $request->skill;
                $candidates = DB::table('candidates')->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'job_id' => $request->job,
                    'phone' => $request->phone,
                    'year' => $request->year,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
                foreach ($skill as $skills){
                    $id = DB::table('candidates')->max('id');
                    DB::table('skill_sets')->insert([
                        'candidates_id' => $id,
                        'skill_id' => $skills
                    ]); 
               
                }
            //    $pelanggan = $request->nama;
            //    $hobi = $request->hobi;
            //    $slug = Str::slug($request->nama,'-');
            //    $insert = [];
            //    for ($i = 0; $i < count($hobi); $i++){
            //     array_push($insert, ['nama' => $pelanggan, 'id_hobi'=>$hobi[$i],'slug' => $slug]);
            //    }
            //    DB::table('pelanggan')->insert($insert);

            });
            
            return redirect('/kandidat')->with(['success'=>'Data Berhasil Disimpan']);
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
        $candidates = DB::table('candidates')
        ->where('candidates.id', $id)
        ->get();
        
        $skill_sets = DB::table('skill_sets')
        ->where('candidates_id',$id)
        ->get();
   
    
        $jobs = DB::table('jobs')->get();
        $skills = DB::table('skills')->get();
        return view('candidates.edit',compact('candidates','jobs','skill_sets','skills'));
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
            'name' => 'required',
            'job' => 'required|numeric',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|numeric|unique:candidates,phone',
            'year' => 'required|numeric',
            'skill' => 'required|numeric'
        ]);
        try{
            DB::transaction(function () use($request, $id){
  
                $skill = $request->skill;
                $candidates = DB::table('candidates')->where('id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'job_id' => $request->job,
                    'phone' => $request->phone,
                    'year' => $request->year,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);

                DB::table('skill_sets')->where('candidates_id',$id)->delete();

                foreach ($skill as $skills){
                    DB::table('skill_sets')->insert([
                        'candidates_id' => $id,
                        'skill_id' => $skills
                    ]); 
               
                }
            //    $pelanggan = $request->nama;
            //    $hobi = $request->hobi;
            //    $slug = Str::slug($request->nama,'-');
            //    $insert = [];
            //    for ($i = 0; $i < count($hobi); $i++){
            //     array_push($insert, ['nama' => $pelanggan, 'id_hobi'=>$hobi[$i],'slug' => $slug]);
            //    }
            //    DB::table('pelanggan')->insert($insert);

            });
            
            return redirect('/kandidat')->with(['success'=>'Data Berhasil Disimpan']);
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
            return redirect()->back();
        }catch(Exception $e){

        }
    }
}

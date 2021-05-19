<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literasi;
use App\Models\Commissariat;
use App\Models\School;
use Str;

class LiterasiController extends Controller
{
    public function literasiKomisariat(){
        try{
            $title = 'Komisariat';
            $fetch = Commissariat::where('status', 'show')->get();
            return view('public.program.bidang_smp.literasi.komisariat', compact('fetch','title'));
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function literasiSekolah($slug){
        try{
            $title = 'Sekolah';
            $komisariat = Commissariat::where(['slug'=>$slug,'status'=>'show'])->first();
            $fetch = School::where(['commissariat_id'=>$komisariat->id,'status'=>'show'])->get();
            return view('public.program.bidang_smp.literasi.sekolah', compact('komisariat','fetch','title'));
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function literasiForm($komisariat, $sekolah){
        try{
            $title = 'Form Literasi';
            $komisariat = Commissariat::where(['slug'=>$komisariat,'status'=>'show'])->first();
            $sekolah = School::where(['slug'=>$sekolah,'status'=>'show'])->first();
            $literasi = Literasi::where(['commissariat_id'=>$komisariat->id, 'school_id'=>$sekolah->id])->get();
            return view('public.program.bidang_smp.literasi.form', compact('komisariat','sekolah','title','literasi'));
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function literasiSubmit(Request $request){
        try{
            //upload file
            if(!empty($request->file('file'))){
                $dok = $request->file('file');
                $extension = $dok->getClientOriginalExtension();
                $file = \Carbon\carbon::now()->translatedFormat('dmy').'-literasi-('.Str::camel($request->nama).').'.$extension;
                $dok->storeAs('public/program_bidang/literasi', $file);
            } else {
                $file = null;
            }
            $data = [
                'commissariat_id'      => $request->input('commissariat_id'),
                'school_id'   => $request->input('school_id'),
                'nama'     => $request->input('nama'),
                'guru_pembimbing'   => $request->input('guru_pembimbing'),
                'mata_pelajaran'   => Str::lower($request->input('mata_pelajaran')),
                'file'    => $file
          ];
          $literasi = Literasi::create($data);
          return redirect()->back()->with(['success' => 'Data Berhasil Dikirim!']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
}

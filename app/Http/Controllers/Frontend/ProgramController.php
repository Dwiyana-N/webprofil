<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literasi;
use App\Models\Commissariat;

class ProgramController extends Controller
{
    public function literasiKomisariat(){
        try{
            $title = 'Komisariat';
            $fetch = Commissariat::where('status', 'show')->get();
            return view('public.program.bidang_smp.komisariat', compact('fetch','title'));
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function literasiSekolah(){
        try{

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function literasiForm(){
        try{

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
}

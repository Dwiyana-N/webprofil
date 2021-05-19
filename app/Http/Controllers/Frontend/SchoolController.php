<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Article;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\School;

class SchoolController extends Controller
{
  public function index(){
    try{
      $sekolah = School::where('status', 'show')->get();
      return view('public.sekolah.list', compact('sekolah'));
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with('error', $error);
    }
  }

  public function show($slug){
    try{
      $sekolah = School::where('slug', $slug)->first();
      return view('public.sekolah.detail', compact('sekolah'));
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with('error', $error);
    }
  }
}

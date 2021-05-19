<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Article;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Student;


class StudentController extends Controller
{
    public function index(){
      try{
        $siswa = Student::where('status', 'show')->get();
        return view('public.siswa.list', compact('siswa'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with('error', $error);
      }
    }

    public function show($slug){
      try{
        $siswa = Student::where('slug', $slug)->first();
        return view('public.siswa.detail', compact('siswa'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with('error', $error);
      }
    }
}

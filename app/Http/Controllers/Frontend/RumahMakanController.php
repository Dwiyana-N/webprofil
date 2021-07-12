<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\RumahMakan;
use App\Models\Makanan;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;

class RumahMakanController extends Controller
{
    public function index(){
        try{
          $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $rm = RumahMakan::where('status', 'show')->latest()->paginate(10);
          return view('public.wisata.rm.list', compact('rm', 'article', 'agenda', 'announcement'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'>$error]);
        }
      }
  
      public function makan($slug){
        try{
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $announcement = Announcement::where('status', 'show')->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $Makanan = Makanan::where('slug',$slug)->first();
          return view('public.wisata.rm.detail', compact('makanan','article','announcement','agenda'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
}



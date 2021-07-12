<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Kesenian;
use App\Models\Budaya;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;

class SeniController extends Controller
{
    public function index(){
        try{
          $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $budaya = Budaya::where('status', 'show')->latest()->paginate(10);
          return view('public.wisata.seni.list', compact('budaya', 'article', 'agenda', 'announcement'));
        }catch(\Exception $e){
          dd($e->getMessage());
          $error = $e->getMessage();
          return redirect()->back()->with(['error'>$error]);
        }
      }
  
      public function seni($slug){
        try{
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $announcement = Announcement::where('status', 'show')->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $seni = Kesenian::where('slug',$slug)->first();
          return view('public.wisata.seni.detail', compact('seni','article','announcement','agenda'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
}


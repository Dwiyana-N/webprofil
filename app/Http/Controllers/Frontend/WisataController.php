<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;


class WisataController extends Controller
{
    public function index(){
        try{
          $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $wisata = Wisata::where('status', 'show')->latest()->paginate(10);
          return view('public.wisata.list', compact('video', 'article', 'agenda', 'announcement'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'>$error]);
        }
      }
  
      public function wisata($slug){
        try{
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $announcement = Announcement::where('status', 'show')->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $wisata = Wisata::where('slug',$slug)->first();
          return view('public.wisata.detail', compact('wisata','article','announcement','agenda'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
}

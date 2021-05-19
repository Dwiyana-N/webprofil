<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\InfoGraphic;
use App\Models\Article;
use App\Models\Agenda;
use App\Models\Announcement;

class InfoGraphicController extends Controller
{
    public function index(){
      try{
        $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
        $article = Article::where('status', 'show')->latest()->limit(5)->get();
        $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
        $infografis = InfoGraphic::where('status', 'show')->latest()->paginate(1);
        return view('public.galeri.infografis.list', compact('infografis', 'article', 'agenda', 'announcement'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'>$error]);
      }
    }

    public function show($slug){
      try{
        $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
        $article = Article::where('status', 'show')->latest()->limit(5)->get();
        $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
        $infografis = InfoGraphic::where('slug',$slug)->first();
        return view('public.galeri.infografis.detail', compact('infografis', 'article', 'agenda', 'announcement'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'>$error]);
      }
    }
}

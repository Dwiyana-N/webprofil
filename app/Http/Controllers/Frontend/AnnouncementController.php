<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;

class AnnouncementController extends Controller
{
  public function index(){
    try{
      $article = Article::where('status', 'show')->latest()->limit(5)->get();
      $announcement = Announcement::where('status', 'show')->latest()->paginate(12);
      $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
      return view('public.pengumuman.list', compact('announcement', 'agenda', 'article'));
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error' => $error]);
    }
  }

  public function show($slug){
    try{
      $announcement = Announcement::where('slug',$slug)->first();
      $updateHit = Announcement::where('id', $announcement->id)->update(['hit'=> $announcement->hit + 1]);
      $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
      $article = Article::where('status', 'show')->latest()->limit(5)->get();
      return view('public.pengumuman.detail', compact('announcement', 'agenda', 'article'));
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error' => $error]);
    }
  }

}

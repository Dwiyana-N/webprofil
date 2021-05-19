<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;

class AgendaController extends Controller
{
  public function index(){
    try{
      $article = Article::where('status', 'show')->latest()->limit(5)->get();
      $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
      $agendas = Agenda::where('status', 'show')->latest()->paginate(12);
      return view('public.agenda.list', compact('announcement', 'agendas', 'article'));
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error' => $error]);
    }
  }

  public function show($slug){
    try{
      $agenda = Agenda::where('slug', $slug)->first();
      $updateHit = Agenda::where('id', $agenda->id)->update(['hit'=> $agenda->hit + 1]);
      $article = Article::where('status', 'show')->latest()->limit(5)->get();
      $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
      return view('public.agenda.detail', compact('announcement', 'agenda', 'article'));
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error' => $error]);
    }
  }
}

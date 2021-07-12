<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Penginapan;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;

class HotelController extends Controller
{
    public function index(){
        try{
          $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $hotel = Hotel::where('status', 'show')->latest()->paginate(10);
          return view('public.wisata.hotel.list', compact('hotel', 'article', 'agenda', 'announcement'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'>$error]);
        }
      }
  
      public function hotel($slug){
        try{
          $article = Article::where('status', 'show')->latest()->limit(5)->get();
          $announcement = Announcement::where('status', 'show')->limit(5)->get();
          $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
          $penginapan = Penginapan::where('slug',$slug)->first();
          return view('public.wisata.hotel.detail', compact('penginapan','article','announcement','agenda'));
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
}




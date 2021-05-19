<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Foto;
use App\Models\Article;
use App\Models\Agenda;
use App\Models\Announcement;

class AlbumController extends Controller
{
    public function index(){
      try{
        $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
        $article = Article::where('status', 'show')->latest()->limit(5)->get();
        $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
        $album = Album::where(['status'=>'show'])->latest()->paginate(1);
        return view('public.galeri.album.list', compact('album', 'article', 'agenda', 'announcement'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function foto($slug){
      try{
        $announcement = Announcement::where('status', 'show')->latest()->limit(5)->get();
        $article = Article::where('status', 'show')->latest()->limit(5)->get();
        $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
        $album = Album::where('slug', $slug)->first();
        $id = $album->id;
        $foto = Foto::where(['album_id'=>$id, 'status'=>'show'])->get();
        return view('public.galeri.album.foto', compact('album', 'foto', 'article', 'agenda', 'announcement'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }
}

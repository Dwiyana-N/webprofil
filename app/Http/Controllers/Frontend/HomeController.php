<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Field;
use App\Models\Staff;
use App\Models\Inbox;
use App\Models\Article;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Album;
use App\Models\Video;
use App\Models\InfoGraphic;
use App\Models\Slider;
use App\Models\Profile;
use DB;

class HomeController extends Controller
{

    public function index(){
      try{
        $announcement = Announcement::where('status', 'show')->latest()->limit(6)->get();
        $agendas = Agenda::where('status', 'show')->latest()->limit(3)->get();
        $blog = Article::where('status', 'show')->latest()->limit(3)->get();
        $staff = Staff::where('status', 'show')->limit(4)->get();
        $slider = Slider::where('status', 'show')->latest()->get();
        return view('public.index', compact('announcement','agendas','blog','slider','staff'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('public.homepage')->with(['error' => $error]);
      }
    }

    public function contactUs(){
      try{
        return view('public.contact');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('public.homepage')->with(['error' => $error]);
      }
    }

    public function sendMessage(Request $request){
      try{
        $data = [
              'name'      => $request->input('name'),
              'address'   => $request->input('address'),
              'email'     => $request->input('email'),
              'subject'   => $request->input('subject'),
              'message'   => $request->input('message'),
              'status'    => "unread"
        ];
        $inbox = Inbox::create($data);
        return redirect()->route('public.contact')->with(['success' => 'Pesan Berhasil Dikirim!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('public.homepage')->with(['error' => $error]);
      }
    }

    public function profile($slug){
      try{
        $article = Article::where('status', 'show')->latest()->limit(5)->get();
        $announcement = Announcement::where('status', 'show')->limit(5)->get();
        $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
        $profil = Profile::where('slug',$slug)->first();
        return view('public.profil.detail', compact('profil','article','announcement','agenda'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function field(){
      try{
        $fetch = Field::where('status', 'show')->get();
        return view('public.kepegawaian.bidang', compact('fetch'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);;
      }
    }

    public function staff($slug){
      try{
        $bidang = Field::where('slug', $slug)->first();
        $fetch = Staff::where(['field_id'=>$bidang->id, 'status'=>'show'])->get();
        return view('public.kepegawaian.pegawai', compact('fetch', 'bidang'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);;
      }
    }

    public function search(Request $request){
      try{
          $search = $request->input('search');
          $table = array('agendas','announcements','articles','videos','albums','info_graphics');
          $searching = array();
          for($i = 0;$i<count($table);$i++){
              if($table[$i] == 'articles'){                  
                $desc = DB::table($table[$i])->get('content');
                $datas = DB::table($table[$i])->select('id as id','title as title','slug as slug','content as desc',DB::raw("@tabel:='{$table[$i]}' as tabel"))->where('title','LIKE','%'.$search.'%')->orWhere('content','LIKE','%'.$search.'%')->latest()->get();
              }else{
                $desc = DB::table($table[$i])->get('description');
                $datas = DB::table($table[$i])->select('id as id','title as title','slug as slug','description as desc',DB::raw("@tabel:='{$table[$i]}' as tabel"))->where('title','LIKE','%'.$search.'%')->orWhere('description','LIKE','%'.$search.'%')->latest()->get();
              }                            
              if(count($datas) != 0){
                $searching[] = $datas;
              }
          }
          $data['keyword'] = $search;
          $data['results'] = $searching;
          return view('public.search', $data);

      }catch(\Exception $e){
        return redirect()->back()->with(['error'=> $e->getMessage()]);        
      }
    }
}

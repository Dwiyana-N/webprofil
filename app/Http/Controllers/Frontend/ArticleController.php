<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use DB;

class ArticleController extends Controller
{
    public function index(){
      try{       
        $post = Article::where('status', 'show')->latest()->paginate(12);
    		$artikelPopuler = $this->loadArtikelPopuler();
    		$arsipArtikel = $this->loadArsipArtikel();
        $kategoriArtikel = $this->loadKategoriArtikel();   

        return view('public.artikel.list', compact('post', 'artikelPopuler', 'arsipArtikel', 'kategoriArtikel'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);
      }
    }

    public function show($slug){
      try{
        $article = Article::where('slug', $slug)->first();
        $updateHit = Article::where('id', $article->id)->update(['hit'=> $article->hit + 1]);
        $tags = Tag::where('status', 'show')->get();
        $category = Category::where('status', 'show')->get();
        $agenda = Agenda::where('status', 'show')->latest()->limit(5)->get();
        $comment = Comment::where(['article_id'=>$article->id, 'status'=>'show'])->latest()->get();
        return view('public.artikel.detail', compact('category', 'tags', 'agenda', 'article', 'comment'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);
      }
    }

    public function sendComment(Request $request){
      try{
        $data = [
              'name'        => $request->input('name'),
              'email'       => $request->input('email'),
              'comment'     => $request->input('comment'),
              'article_id'  => $request->input('article_id')
        ];
        $inbox = Comment::create($data);
        return redirect()->back()->with(['success' => 'Komentar Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);
      }
    }

    public function archive($year, $month){
      try{        
    		$artikelPopuler = $this->loadArtikelPopuler();
    		$arsipArtikel = $this->loadArsipArtikel();
        $kategoriArtikel = $this->loadKategoriArtikel();
        $date = ['year'=>$year, 'month'=>$month];
        $data= Article::whereYear('created_at',$year)->whereMonth('created_at',$month)->orderBy('created_at', 'DESC')->paginate(10);
        return view('public.artikel.archive', compact('data', 'date', 'artikelPopuler', 'arsipArtikel', 'kategoriArtikel'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function category($category){
      try{        
    		$artikelPopuler = $this->loadArtikelPopuler();
    		$arsipArtikel = $this->loadArsipArtikel();
        $kategoriArtikel = $this->loadKategoriArtikel();
        
        $slug = Category::where('slug',$category)->first();
        //$data= Article::join('categories','categories.id','=','articles.category_id')->where('categories.slug',$category)->latest('articles.created_at')->paginate(10);
        $data= Article::where('category_id',$slug->id)->latest()->paginate(10);
        return view('public.artikel.category', compact('data', 'slug', 'artikelPopuler', 'arsipArtikel', 'kategoriArtikel'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function tag($tag){
      try{        
    		$artikelPopuler = $this->loadArtikelPopuler();
    		$arsipArtikel = $this->loadArsipArtikel();
        $kategoriArtikel = $this->loadKategoriArtikel();
        
        $slug = Tag::where('slug',$tag)->first();        
        $data= Article::where('category_id',$slug->id)->latest()->paginate(10);
        return view('public.artikel.category', compact('data', 'tagArtikel', 'artikelPopuler', 'arsipArtikel', 'kategoriArtikel'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

	  private function loadArsipArtikel(){
        $arsip = Article::select(DB::raw('YEAR(created_at) as year'),DB::raw('MONTH(created_at) as month'),DB::raw('count(id) as total'))->where('status','show')->groupBy('year','month')->orderBy('created_at', 'DESC')->get();
        return $arsip;
    }

    private function loadArtikelPopuler(){
        $populer = Article::where('status','show')->orderBy('hit','desc')->limit(5)->get();
        return $populer;
    }

    private function loadKategoriArtikel(){
        $kategori = Article::select(DB::raw('count(category_id) as total'),'category_id')->where('status','show')->groupBy('category_id')->get();
        return $kategori;
    }

    private function loadTagArtikel(){
      $articles = Article::whereHas('tags', function($query) use ($tagName) {
                    $query->whereName($tagName);
                  })->get();
        return $article;
    }

}

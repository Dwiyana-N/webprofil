<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Image;
use SoftDelete;
use Str;
use Auth;

class ArticleController extends Controller
{
    public function index(){
      try{
        $data['post'] = Article::orderBy('created_at', 'DESC')->get();
        return view('admin.postingan.artikel.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $data['post'] = Article::where('id', $id)->first();
        return view('admin.postingan.artikel.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        $data['category'] = Category::where('status','show')->get();
        $data['tag'] = Tag::where('status','show')->get();
        return view('admin.postingan.artikel.create', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{
        //upload image
        if(!empty($request->file('img'))){
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmy').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/article/images', $img);
          $thumbnailPath = public_path('thumbnails/');
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
        } else {
          $img = null;
        }
        $data = $this->bindData($request);
        $data['img'] = $img;
        $data['thumbnail'] = $img;
        $data['created_by'] = Auth::user()->name;
        $article = Article::create($data);
        $article->tags()->attach($request->tags);
        return redirect()->route('admin.article.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\QueryException $e){
        $basename = basename($img);
        $image = Storage::disk('local')->delete('public/article/images/'.$basename);
        $thumb_path = public_path('thumbnails/'.$img);
        if(File::exists($thumb_path)) {
            File::delete($thumb_path);
        }
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $data['article'] = Article::findOrFail($id);
        $data['category'] = Category::where('status','show')->get();
        $data['tag'] = Tag::where('status','show')->get();
        return view('admin.postingan.artikel.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $article = Article::where('id',$id)->first();
        //cek jika image kosong
        if($request->file('img') == '') {
            //update tanpa image
            $article = Article::findOrFail($id);
            $data = $this->bindData($request);
            $article->tags()->sync($request->tags);
            $article->update($data);
        } else {
            //hapus image lama
            $basename = basename($article->img);
            $images = Storage::disk('local')->delete('public/article/images/'.$basename);
            $thumb_path = public_path('thumbnails/'.$article->thumbnail);
            if(File::exists($thumb_path)) {
                File::delete($thumb_path);
            }
            //upload image baru
            $image = $request->file('img');
            $extension = $image->getClientOriginalExtension();
            $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
            $image->storeAs('public/article/images', $img);
            $thumbnailPath = public_path('thumbnails/');
            $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
            //update dengan image
            $data = $this->bindData($request);
            $data['img'] = $img;
            $data['thumbnail'] = $img;
            $data['updated_by'] = Auth::user()->name;
            $article = Article::findOrFail($id);
            $article->tags()->sync($request->tags);
            $article->update($data);
        }
        return redirect()->route('admin.article.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.article.list')->with(['success' => 'Data Telah Masuk Ke Tong Sampah!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function trash()
    {
      try{
        $post = Article::orderBy('deleted_at', 'DESC')->onlyTrashed()->get();
        return view('admin.postingan.artikel.trash', compact('post'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.article.list')->with(['error' => $error]);
      }
    }

    public function restore($id)
    {
      try{
        $post = Article::withTrashed()->where('id',$id)->first();
        $post->restore();
        return redirect()->route('admin.trash.list')->with(['success' => 'Data Berhasil Dipulihkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.trash.list')->with(['error' => $error]);
      }
    }

    public function destroy(Request $request){
      try{
        $id = $request->input('id');
        $article = Article::withTrashed()->where('id',$id)->first();
        $basename1 = basename($article->img);
        $image = Storage::disk('local')->delete('public/article/images/'.$basename1);
        $thumb_path = public_path('thumbnails/'.$article->thumbnail);
        if(File::exists($thumb_path)) {
            File::delete($thumb_path);
        }
        $article->tags()->detach($article->thumbnail);
        $article->forceDelete();
        return redirect()->route('admin.trash.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.trash.list')->with(['error' => $error]);
      }
    }

    public function bindData($request){
      if(!empty($request->id)){
          $article = Article::find($request->id);
      }
      $data = [
            'category_id'       => $request->input('category_id'),
            'title'             => $request->input('title'),
            'slug'              => Str::slug($request->input('title')),
            'short_description' => $request->input('short_description'),
            'content'           => $request->input('content'),
            'status'            => $request->input('status'),
      ];
      return $data;

    }

}

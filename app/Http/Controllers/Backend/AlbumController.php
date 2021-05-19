<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Album;
use App\Models\Foto;
use Str;
use Auth;

class AlbumController extends Controller
{
  public function index(){
    try{
      $data['album'] = Album::latest()->get();
      return view('admin.galeri.album.list', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function show($id){
    try{
      $data['fetch'] = Album::where('id', $id)->first();
      $data['foto'] = Foto::where('album_id', $id)->get();
      return view('admin.galeri.album.detail', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function create(){
    try{
      return view('admin.galeri.album.create');
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function store(Request $request){
    try{
      $data = $this->bindData($request);
      $data['created_by'] = Auth::user()->name;
      $add = Album::create($data);
      return redirect()->route('admin.album.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function edit($id){
    try{
      $data['fetch'] = Album::findOrFail($id);
      return view('admin.galeri.album.edit', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function update(Request $request){
    try{
      $id = $request->input('id');
      $fetch = Album::where('id',$id)->first();
      $basename = basename($fetch->thumbnail);
      $thumbnail = Storage::disk('local')->delete('public/gallery/album/thumbs/'.$basename);
      $data = $this->bindData($request);
      $data['updated_by'] = Auth::user()->name;
      $get = Album::findOrFail($id);
      $get->update($data);
      return redirect()->route('admin.album.list')->with(['success' => 'Data Berhasil Disimpan!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function delete(Request $request){
    try{
      $id = $request->input('id');
      $fetch = Album::findOrFail($id);
      $basename = basename($fetch->thumbnail);
      $thumbnail = Storage::disk('local')->delete('public/gallery/album/thumbs/'.$basename);
      $fetch->delete();
      return redirect()->route('admin.album.list')->with(['success' => 'Data Telah Dihapus!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->route('admin.album.list')->with(['error'=>$error]);
    }
  }

  public function bindData($request){
    if(!empty($request->id)){
        $fetch = Album::find($request->id);
    }
    //upload image
    if(!empty($request->file('thumbnail'))){
      $thumbnail = $request->file('thumbnail');
      $thumb = $thumbnail->hashName();
      $thumbnail->storeAs('public/gallery/album/thumbs', $thumb);
    } else {
      $thumb = null;
    }
      $data = [
          'title'       => $request->input('title'),
          'slug'        => Str::slug($request->input('title')),
          'description' => $request->input('description'),
          'thumbnail'   => $thumb,
          'status'      => $request->input('status')
      ];
      return $data;
  }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Foto;
use App\Models\Album;
use Str;
use Auth;

class PhotoController extends Controller
{

  public function show($id){
    try{
      $data['fetch'] = Foto::where('id', $id)->first();
      return view('admin.galeri.foto.detail', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function create(){
    try{
      $data['album'] = Album::where('status', 'show')->get();
      return view('admin.galeri.foto.create', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function store(Request $request){
    try{
      $data = $this->bindData($request);
      $data['created_by'] = Auth::user()->name;
      $add = Foto::create($data);
      return redirect()->back()->with(['success' => 'Data Berhasil Ditambahkan!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function edit($id){
    try{
      $data['fetch'] = Foto::findOrFail($id);
      $data['album'] = Album::where('status', 'show')->get();
      return view('admin.galeri.foto.edit', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function update(Request $request){
    try{
      $id = $request->input('id');
      $photo = Foto::where('id',$id)->first();
      $basefile = basename($photo->img);
      $image = Storage::disk('local')->delete('public/gallery/photo/images/'.$basefile);
      $data = $this->bindData($request);
      $data['updated_by'] = Auth::user()->name;
      $foto = Foto::findOrFail($id);
      $foto->update($data);
      return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function delete(Request $request){
    try{
      $id = $request->input('id');
      $photo = Foto::findOrFail($id);
      $basefile = basename($photo->img);
      $image = Storage::disk('local')->delete('public/gallery/photo/images/'.$basefile);
      $photo->delete();
      return redirect()->back()->with(['success' => 'Data Telah Dihapus!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function bindData($request){
    if(!empty($request->id)){
      $fetch = Foto::find($request->id);
    }
    //upload image
    if(!empty($request->file('img'))){
      $image = $request->file('img');
      $img = $image->hashName();
      $image->storeAs('public/gallery/photo/images', $img);
    } else {
      $img = null;
    }

      $data = [
          'album_id'    => $request->input('album_id'),
          'name'        => $request->input('name'),
          'description' => $request->input('description'),
          'img'         => $img,
          'status'      => $request->input('status')
      ];
      return $data;
  }
}

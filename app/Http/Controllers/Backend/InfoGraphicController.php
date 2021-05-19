<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\InfoGraphic;
use Str;
use Auth;

class InfoGraphicController extends Controller
{
    public function index(){
      try{
        $data['infographic'] = InfoGraphic::latest()->get();
        return view('admin.galeri.infografis.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function show($id){
      try{
        $data['fetch'] = InfoGraphic::where('id', $id)->first();
        return view('admin.galeri.infografis.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function create(){
      try{
        return view('admin.galeri.infografis.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function store(Request $request){
      try{
        $data = $this->bindData($request);
        $data['created_by'] = Auth::user()->name;
        $add = InfoGraphic::create($data);
        return redirect()->route('admin.infographic.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = InfoGraphic::findOrFail($id);
        return view('admin.galeri.infografis.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $infographic = InfoGraphic::where('id',$id)->first();
        $basename = basename($infographic->thumbnail);
        $thumbnail = Storage::disk('local')->delete('public/gallery/infographic/thumbs/'.$basename);
        $basefile = basename($infographic->img);
        $image = Storage::disk('local')->delete('public/gallery/infographic/images/'.$basefile);
        $data = $this->bindData($request);
        $data['updated_by'] = Auth::user()->name;
        $infographic = InfoGraphic::findOrFail($id);
        $infographic->update($data);
        return redirect()->route('admin.infographic.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $fetch = InfoGraphic::findOrFail($id);
        $basename = basename($fetch->thumbnail);
        $thumbnail = Storage::disk('local')->delete('public/gallery/infographic/thumbs/'.$basename);
        $basefile = basename($fetch->img);
        $image = Storage::disk('local')->delete('public/gallery/infographic/images/'.$basefile);
        $fetch->delete();
        return redirect()->route('admin.infographic.list')->with(['success' => 'Data Telah Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.infographic.list')->with(['error'=>$error]);
      }
    }

    public function bindData($request){
      if(!empty($request->id)){
          $fetch = InfoGraphic::find($request->id);
      }
      //upload image
      if(!empty($request->file('img'))){
        $image = $request->file('img');
        $img = $image->hashName();
        $image->storeAs('public/gallery/infographic/images', $img);
      } else {
        $img = null;
      }
      if(!empty($request->file('img'))){
        $thumbnail = $request->file('img');
        $thumb = $thumbnail->hashName();
        $thumbnail->storeAs('public/gallery/infographic/thumbs', $thumb);
      } else {
        $thumb = null;
      }
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'description' => $request->input('description'),
            'img'         => $img,
            'thumbnail'   => $thumb,
            'status'      => $request->input('status')
        ];
        return $data;
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;
use Str;
use Auth;

class VideoController extends Controller
{
    public function index(){
      try{
        $data['video'] = Video::latest()->get();
        return view('admin.galeri.video.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function show($id){
      try{
        $data['fetch'] = Video::where('id', $id)->first();
        return view('admin.galeri.video.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function create(){
      try{
        return view('admin.galeri.video.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function store(Request $request){
      try{
        $data = $this->bindData($request);
        $data['created_by'] = Auth::user()->name;
        $add = Video::create($data);
        return redirect()->route('admin.video.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = Video::findOrFail($id);
        return view('admin.galeri.video.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function update(Request $request){
      try{
        //dd($request);
        $id = $request->input('id');
        $video = Video::where('id',$id)->first();
        $basename = basename($video->thumbnail);
        $thumbnail = Storage::disk('local')->delete('public/gallery/video/thumbs/'.$basename);
        $data = $this->bindData($request);
        $data['updated_by'] = Auth::user()->name;
        $video = Video::findOrFail($id);
        $video->update($data);
        return redirect()->route('admin.video.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $fetch = Video::findOrFail($id);
        $basename = basename($fetch->thumbnail);
        $thumbnail = Storage::disk('local')->delete('public/gallery/video/thumbs/'.$basename);
        $fetch->delete();
        return redirect()->route('admin.video.list')->with(['success' => 'Data Telah Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.video.list')->with(['error'=>$error]);
      }
    }

    public function bindData($request){
      if(!empty($request->id)){
          $fetch = Video::find($request->id);
      }
      //upload image
      if(!empty($request->file('thumbnail'))){
        $image = $request->file('thumbnail');
        $img = $image->hashName();
        $image->storeAs('public/gallery/video/thumbs', $img);
      } else {
        $img = null;
      }
        $data = [
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'url'         => $request->input('url'),
            'description' => $request->input('description'),
            'thumbnail'   => $img,
            'status'      => $request->input('status')
        ];
        return $data;
    }

}

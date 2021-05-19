<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Announcement;
use Image;
use Str;
use Auth;

class AnnouncementController extends Controller
{

    public function index(){
      try{
        $data['announcement'] = Announcement::orderBy('created_at', 'DESC')->get();
        return view('admin.pengumuman.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $announce = Announcement::findOrFail($id);
        return view('admin.pengumuman.detail', compact('announce'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        return view('admin.pengumuman.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{        
        //upload image
        if(!empty($request->file('img'))){
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmy').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/announcement/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
        } else {
          $img = null;
        }
        //upload file
        if(!empty($request->file('file'))){
          $dok = $request->file('file');
          $extension = $dok->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmy').'-('.Str::camel($request->title).').'.$extension;
          $dok->storeAs('public/announcement/files', $file);
        } else {
          $file = null;
        }
        $data = $this->bindData($request);
        $data['img']        = $img;
        $data['thumbnail']  = $img;
        $data['file']       = $file;
        $data['created_by'] = Auth::user()->name;
        $announce = Announcement::create($data);
        return redirect()->route('admin.announcement.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\QueryException $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $announcement = Announcement::findOrFail($id);
        return view('admin.pengumuman.edit', compact('announcement'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $announce = Announcement::where('id',$id)->first();
        //cek jika image dan file kosong
        if($request->file('img')=='' && $request->file('file')=='') {
          //update tanpa image
          $announce = Announcement::findOrFail($id);
          $data = $this->bindData($request);
          $data['updated_by'] = Auth::user()->name;          
          $announce->update($data);
        } else if(!empty($request->file('img')) && $request->file('file')=='') { 
          //hapus image lama
          $basename = basename($announce->img);            
          $images = Storage::disk('local')->delete('public/announcement/images/'.$basename);
          $thumb_path = public_path('thumbnails/'.$announce->thumbnail);
          if(File::exists($thumb_path)) {
              File::delete($thumb_path);
          }
          //upload image baru
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/announcement/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
          //update dengan image       
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['thumbnail'] = $img;
          $data['updated_by'] = Auth::user()->name;
          $announce = Announcement::findOrFail($id);
          $announce->update($data);
        } else if(!empty($request->file('file')) && $request->file('img')=='') {
          //hapus file lama
          $basenameFile = basename($announce->file);            
          $file = Storage::disk('local')->delete('public/announcement/images/'.$basenameFile);          
          //upload file baru
          $input = $request->file('file');
          $extension = $input->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $input->storeAs('public/announcement/files', $file);         
          //update dengan file       
          $data = $this->bindData($request);
          $data['file'] = $file;          
          $data['updated_by'] = Auth::user()->name;
          $announce = Announcement::findOrFail($id);
          $announce->update($data);
        } else {
          //hapus data lama
          $basenameFile = basename($announce->file);            
          $file = Storage::disk('local')->delete('public/announcement/images/'.$basenameFile);
          $basename = basename($announce->img);            
          $images = Storage::disk('local')->delete('public/announcement/images/'.$basename);
          $thumb_path = public_path('thumbnails/'.$announce->thumbnail);
          if(File::exists($thumb_path)) {
              File::delete($thumb_path);
          }
          //upload data baru
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/announcement/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
          $input = $request->file('file');
          $extension = $input->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $input->storeAs('public/announcement/files', $file);        
          //update       
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['thumbnail'] = $img;
          $data['file'] = $file;          
          $data['updated_by'] = Auth::user()->name;
          $announce = Announcement::findOrFail($id);
          $announce->update($data);
        }        
        return redirect()->route('admin.announcement.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $announce = Announcement::find($id);
        $basenameImg = basename($announce->img);
        $basenameFile = basename($announce->file);
        $image = Storage::disk('local')->delete('public/announcement/images/'.$basenameImg);
        $file = Storage::disk('local')->delete('public/announcement/files/'.$basenameFile);
        $thumb_path = public_path('thumbnails/'.$announce->thumbnail);
        if(File::exists($thumb_path)) {
          File::delete($thumb_path);
        }
        $announce->delete();
        return redirect()->route('admin.announcement.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function bindData($request){
      if(!empty($request->id)){
          $agenda = Announcement::find($request->id);
      }      
      $data = [
            'title'             => $request->input('title'),
            'slug'              => Str::slug($request->input('title')),
            'description'       => $request->input('description'),            
            'status'            => $request->input('status'),
      ];
      return $data;
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Str;
use Auth;

class PelayananController extends Controller
{
    public function index(){
        try{
          $data['list'] = Pelayanan::orderBy('created_at', 'DESC')->get();
          return view('admin.pelayanan.list', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function show($id){
        try{
          $data['fetch'] = Pelayanan::where('id', $id)->first();
          return view('admin.pelayanan.detail', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function create(){
        try{
          return view('admin.pelayanan.create');
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function store(Request $request){
        try{
          //upload image
          if(!empty($request->file('img'))){
            $image = $request->file('img');          
            $extension = $image->getClientOriginalExtension();
            $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::slug($request->title).').'.$extension;
            $image->storeAs('public/pelayanan/images', $img);
          } else {
            $img = null;
          }
          //upload file
          if(!empty($request->file('file'))){
            $dok = $request->file('file');
            $extension = $dok->getClientOriginalExtension();
            $file = \Carbon\carbon::now()->translatedFormat('dmy').'-('.Str::camel($request->title).').'.$extension;
            $dok->storeAs('public/pelayanan/files', $file);
          } else {
            $file = null;
          }
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['file'] = $file;
          $data['created_by'] = Auth::user()->name;
          $store = Pelayanan::create($data);
          return redirect()->route('admin.pelayanan.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          //return $error;
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function edit($id){
        try{
          $data['fetch'] = Pelayanan::where('id', $id)->first();
          return view('admin.pelayanan.edit', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function update(Request $request){
        try{
          $id = $request->input('id');   
          $layanan = Pelayanan::where('id', $id)->first();

          //cek jika image dan file kosong
        if($request->file('img')=='' && $request->file('file')=='') {
          //update tanpa image
          $layanan = Pelayanan::findOrFail($id);
          $data = $this->bindData($request);
          $data['updated_by'] = Auth::user()->name;          
          $layanan->update($data);
        } else if(!empty($request->file('img')) && $request->file('file')=='') { 
          //hapus image lama
          $basename = basename($layanan->img);            
          $images = Storage::disk('local')->delete('public/pelayanan/images/'.$basename);
          $thumb_path = public_path('thumbnails/'.$layanan->thumbnail);
          if(File::exists($thumb_path)) {
              File::delete($thumb_path);
          }
          //upload image baru
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/pelayanan/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
          //update dengan image       
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['thumbnail'] = $img;
          $data['updated_by'] = Auth::user()->name;
          $layanan = Pelayanan::findOrFail($id);
          $layanan->update($data);
        } else if(!empty($request->file('file')) && $request->file('img')=='') {
          //hapus file lama
          $basenameFile = basename($layanan->file);            
          $file = Storage::disk('local')->delete('public/pelayanan/images/'.$basenameFile);          
          //upload file baru
          $input = $request->file('file');
          $extension = $input->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $input->storeAs('public/pelayanan/files', $file);         
          //update dengan file       
          $data = $this->bindData($request);
          $data['file'] = $file;          
          $data['updated_by'] = Auth::user()->name;
          $layanan = Pelayanan::findOrFail($id);
          $layanan->update($data);
        } else {
          //hapus data lama
          $basenameFile = basename($layanan->file);            
          $file = Storage::disk('local')->delete('public/pelayanan/images/'.$basenameFile);
          $basename = basename($layanan->img);            
          $images = Storage::disk('local')->delete('public/pelayanan/images/'.$basename);
          $thumb_path = public_path('thumbnails/'.$layanan->thumbnail);
          if(File::exists($thumb_path)) {
              File::delete($thumb_path);
          }
          //upload data baru
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/pelayanan/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
          $input = $request->file('file');
          $extension = $input->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $input->storeAs('public/pelayanan/files', $file);        
          //update       
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['thumbnail'] = $img;
          $data['file'] = $file;          
          $data['updated_by'] = Auth::user()->name;
          $layanan = Pelayanan::findOrFail($id);
          $layanan->update($data);
        }        

          return redirect()->route('admin.pelayanan.list')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function delete(Request $request){
        try{
          $id = $request->input('id');
          $catch = Pelayanan::findOrFail($id);
          $catch->delete();
          return redirect()->route('admin.pelayanan.list')->with(['success' => 'Data Berhasil Dihapus!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function bindData($request){
        if(!empty($request->id)){
          $get = Pelayanan::find($request->id);
      }
        $data = [            
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),          
            'description' => $request->input('description'),           
            'status'      => $request->input('status'),
        ];
        return $data;
      }
      
  }
  

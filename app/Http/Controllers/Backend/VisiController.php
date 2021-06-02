<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Visi;
use App\Models\Website;
use Str;
use Auth;

class VisiController extends Controller
{
  public function index(){
    try{
      $data['list'] = Visi::orderBy('created_at', 'DESC')->get();
      return view('admin.profil.visi.list', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function show($id){
    try{
      $data['fetch'] = Visi::where('id', $id)->first();
      return view('admin.profil.visi.detail', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function create(){
    try{
      return view('admin.profil.visi.create');
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
        $image->storeAs('public/visi/images', $img);
      } else {
        $img = null;
      }
  
      $data = $this->bindData($request);
      $data['img'] = $img;
      $data['file'] = $file;
      $data['created_by'] = Auth::user()->name;
      $store = Visi::create($data);
      return redirect()->route('admin.profil.visi.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      //return $error;
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function edit($id){
    try{
      $data['fetch'] = Visi::where('id', $id)->first();
      return view('admin..profil.visi.edit', $data);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function update(Request $request){
    try{
      $id = $request->input('id');   
      $visi = Visi::where('id', $id)->first();
      //upload gambar
      if( $request->file('img') == '' ) {
        if($visi->img){
          $img = $visi->img;
        }else{
          $img = null;
        }
      } else {
        $image = $request->file('img');
        $extension = $image->getClientOriginalExtension();
        $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::slug($request->title).').'.$extension;
        $baseimage = basename($visi->img);
        $imagepic = Storage::disk('local')->delete('public/visi/images/'.$baseimage);
        $image->storeAs('public/visi/images/', $img);
      }
      
      $data = $this->bindData($request);
      $data['img'] = $img;
      $data['file'] = $file;
      $data['updated_by'] = Auth::user()->name;
      $visi->update($data);
      return redirect()->route('admin.profil.visi.list')->with(['success' => 'Data Berhasil Disimpan!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function delete(Request $request){
    try{
      $id = $request->input('id');
      $catch = Profile::findOrFail($id);
      $catch->delete();
      return redirect()->route('admin.profil.visi.list')->with(['success' => 'Data Berhasil Dihapus!']);
    }catch(\Exception $e){
      $error = $e->getMessage();
      return redirect()->back()->with(['error'=>$error]);
    }
  }

  public function bindData($request){
    if(!empty($request->id)){
      $get = Profile::find($request->id);
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
  

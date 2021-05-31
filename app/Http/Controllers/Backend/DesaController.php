<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Desa;
use App\Models\Website;
use Str;
use Auth;

class DesaController extends Controller
{

    public function index(){
      try{
        $data['list'] = Desa::orderBy('created_at', 'DESC')->get();
        return view('admin.desa.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function show($id){
      try{
        $data['fetch'] = Desa::where('id', $id)->first();
        return view('admin.desa.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function create(){
      try{
        return view('admin.desa.create');
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
          $image->storeAs('public/desa/images', $img);
        } else {
          $img = null;
        }
    
        $data = $this->bindData($request);
        $data['img'] = $img;
        $data['file'] = $file;
        $data['created_by'] = Auth::user()->name;
        $store = Desa::create($data);
        return redirect()->route('admin.desa.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        //return $error;
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = Desa::where('id', $id)->first();
        return view('admin.desa.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');   
        $desa = Desa::where('id', $id)->first();
        //upload gambar
        if( $request->file('img') == '' ) {
          if($desa->img){
            $img = $desa->img;
          }else{
            $img = null;
          }
        } else {
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::slug($request->title).').'.$extension;
          $baseimage = basename($profil->img);
          $imagepic = Storage::disk('local')->delete('public/desa/images/'.$baseimage);
          $image->storeAs('public/desa/images/', $img);
        }
        
        $data = $this->bindData($request);
        $data['img'] = $img;
        $data['file'] = $file;
        $data['updated_by'] = Auth::user()->name;
        $profil->update($data);
        return redirect()->route('admin.desa.list')->with(['success' => 'Data Berhasil Disimpan!']);
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
        return redirect()->route('admin.desa.list')->with(['success' => 'Data Berhasil Dihapus!']);
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

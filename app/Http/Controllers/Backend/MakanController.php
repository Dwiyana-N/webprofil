<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Makan;
use App\Models\Profile;
use App\Models\Website;
use Str;
use Auth;

class MakanController extends Controller
{
    public function index(){
        try{
          $data['list'] = Makan::orderBy('created_at', 'DESC')->get();
          return view('admin.makan.list', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function show($id){
        try{
          $data['fetch'] = Makan::where('id', $id)->first();
          return view('admin.makan.detail', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function create(){
        try{
          return view('admin.makan.create');
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
            $image->storeAs('public/makan/images', $img);
          } else {
            $img = null;
          }
          
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['created_by'] = Auth::user()->name;
          $store = Makan::create($data);
          return redirect()->route('admin.makan.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function edit($id){
        try{
          $data['fetch'] = Makan::where('id', $id)->first();
          return view('admin.makan.edit', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function update(Request $request){
        try{
          $id = $request->input('id');   
          $profil = Makan::where('id', $id)->first();
          //upload gambar
          if( $request->file('img') == '' ) {
            if($profil->img){
              $img = $profil->img;
            }else{
              $img = null;
            }
          } else {
            $image = $request->file('img');
            $extension = $image->getClientOriginalExtension();
            $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::slug($request->title).').'.$extension;
            $baseimage = basename($profil->img);
            $imagepic = Storage::disk('local')->delete('public/makan/images/'.$baseimage);
            $image->storeAs('public/makan/images/', $img);
          }
          
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['updated_by'] = Auth::user()->name;
          $profil->update($data);
          return redirect()->route('admin.makan.list')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function delete(Request $request){
        try{
          $id = $request->input('id');
          $catch = makan::findOrFail($id);
          $catch->delete();
          return redirect()->route('admin.makan.list')->with(['success' => 'Data Berhasil Dihapus!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function bindData($request){
        if(!empty($request->id)){
          $get = Makan::find($request->id);
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



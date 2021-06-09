<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Sejarah;
use App\Models\Profile;
use App\Models\Website;
use Str;
use Auth;

class SejarahController extends Controller
{
    public function index(){
        try{
          $data['list'] = Sejarah::orderBy('created_at', 'DESC')->get();
          return view('admin.profil.sejarah.list', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function show($id){
        try{
          $data['fetch'] = Sejarah::where('id', $id)->first();
          return view('admin.profil.sejarah.detail', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function create(){
        try{
          return view('admin.profil.sejarah.create');
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function store(Request $request){
        try{
          $data = $this->bindData($request);
          $data['created_by'] = Auth::user()->name;
          $store = Sejarah::create($data);
          return redirect()->route('admin.profil.sejarah.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function edit($id){
        try{
          $data['fetch'] = Sejarah::where('id', $id)->first();
          return view('admin.profil.sejarah.edit', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function update(Request $request){
        try{
          $id = $request->input('id');   
          $layanan = Sejarah::where('id', $id)->first();

          $data = $this->bindData($request);
          $data['updated_by'] = Auth::user()->name;
          $layanan->update($data);
          return redirect()->route('admin.profil.sejarah.list')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function delete(Request $request){
        try{
          $id = $request->input('id');
          $catch = Sejarah::findOrFail($id);
          $catch->delete();
          return redirect()->route('admin.profil.sejarah.list')->with(['success' => 'Data Berhasil Dihapus!']);
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
  

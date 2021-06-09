<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Topografi;
use Illuminate\Http\Request;

class TopografiController extends Controller
{
    public function index(){
        try{
          $data['list'] = Topografi::orderBy('created_at', 'DESC')->get();
          return view('admin.topografi.list', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function show($id){
        try{
          $data['fetch'] = Topografi::where('id', $id)->first();
          return view('admin.topografi.detail', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }

      public function create(){
        try{
          return view('admin.topografi.create');
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function store(Request $request){
        try{
          $data = $this->bindData($request);
          $data['created_by'] = Auth::user()->name;
          $store = Topografi::create($data);
          return redirect()->route('admin.topografi.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          //return $error;
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function edit($id){
        try{
          $data['fetch'] = Topografi::where('id', $id)->first();
          return view('admin.topografi.edit', $data);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function update(Request $request){
        try{
          $id = $request->input('id');   
          $topografi = Topografi::where('id', $id)->first();

          $data = $this->bindData($request);
          $data['updated_by'] = Auth::user()->name;
          $topografi->update($data);
          return redirect()->route('admin.topografi.list')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function delete(Request $request){
        try{
          $id = $request->input('id');
          $catch = Topografi::findOrFail($id);
          $catch->delete();
          return redirect()->route('admin.topografi.list')->with(['success' => 'Data Berhasil Dihapus!']);
        }catch(\Exception $e){
          $error = $e->getMessage();
          return redirect()->back()->with(['error'=>$error]);
        }
      }
  
      public function bindData($request){
        if(!empty($request->id)){
          $get = Topografi::find($request->id);
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
  

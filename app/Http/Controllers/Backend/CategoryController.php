<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Category;
use Str;
use Auth;

class CategoryController extends Controller
{
    public function index(){
      try{
        $data['list'] = Category::orderBy('created_at', 'DESC')->get();
        return view('admin.postingan.kategori.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.category.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        return view('admin.postingan.kategori.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.category.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{
        // $this->validasiForm($request);
        $data = $this->bindData($request);
        $data['created_by'] = Auth::user()->name;
        $kategori = Category::create($data);
        return redirect()->route('admin.category.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.category.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = Category::where('id', $id)->first();
        return view('admin.postingan.kategori.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.category.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        // $this->validasiForm($request);
        $id = $request->input('id');
        $data = $this->bindData($request);
        $data['updated_by'] = Auth::user()->name;
        $category = Category::findOrFail($id);
        $category->update($data);
        return redirect()->route('admin.category.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(QueryException $e){
        $error = $e->getMessage();
        return redirect()->route('admin.category.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.category.list')->with(['error' => $error]);
      }
    }

    public function bindData($request)
    {
      if(!empty($request->id)){
          $tag = Category::find($request->id);
      }
      if(!empty($request->status)){
        $status = $request->input('status');
      } else {
        $status = "show";
      }
        $data = [
            'name'    => $request->input('name'),
            'slug'    => Str::slug($request->input('name')),
            'status'  => $status
        ];
        return $data;
    }
}

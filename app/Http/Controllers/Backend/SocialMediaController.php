<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\SocialMedia;
use Str;
use Auth;

class SocialMediaController extends Controller
{
    public function index(){
      try{
        $data['list'] = SocialMedia::orderBy('created_at', 'DESC')->get();
        return view('admin.sosmed.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.socmed.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        return view('admin.sosmed.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.socmedlist')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{
        $data = [
            'name'        => $request->input('name'),
            'icon'        => $request->input('icon'),
            'url'         => $request->input('url'),
            'status'      => $request->input('status'),
        ];
        $data['created_by'] = Auth::user()->name;
        $store = SocialMedia::create($data);
        return redirect()->route('admin.socmed.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.socmed.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = SocialMedia::where('id', $id)->first();
        return view('admin.sosmed.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.socmed.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $fetch = SocialMedia::findOrFail($id);
        $fetch->update([
            'name'        => $request->input('name'),
            'icon'        => $request->input('icon'),
            'url'         => $request->input('url'),
            'status'      => $request->input('status'),
            'updated_by'  => Auth::user()->name,
        ]);
        return redirect()->route('admin.socmed.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(QueryException $e){
        $error = $e->getMessage();
        return redirect()->route('admin.socmed.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $fetch = SocialMedia::find($id);
        $fetch->delete();
        return redirect()->route('admin.socmed.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.socmed.list')->with(['error' => $error]);
      }
    }
}

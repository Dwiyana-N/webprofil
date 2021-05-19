<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Field;
use Str;
use Auth;

class FieldController extends Controller
{
    public function index(){
      try{
        $data['list'] = Field::orderBy('created_at', 'DESC')->get();
        return view('admin.unitkerja.bidang.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.field.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        return view('admin.unitkerja.bidang.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.field.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{
        //upload image
        if(!empty($request->file('img'))){
          $image = $request->file('img');
          $img = $image->hashName();
          $image->storeAs('public/field/images', $img);
        } else {
          $img = null;
        }
        $data = [
            'name'        => $request->input('name'),
            'slug'        => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'img'         => $img,
            'status'      => $request->input('status'),
        ];
        $store = Field::create($data);
        return redirect()->route('admin.field.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.field.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = Field::where('id', $id)->first();
        return view('admin.unitkerja.bidang.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.field.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $field = Field::where('id',$id)->first();
        //cek jika image kosong
        if($request->file('img') == '') {
            //update tanpa image
            $field = Field::findOrFail($id);
            $field->update([
              'name'        => $request->input('name'),
              'slug'        => Str::slug($request->input('name')),
              'description' => $request->input('description'),
              'status'      => $request->input('status'),
            ]);
        } else {
            //hapus image lama
            $basename = basename($field->img);
            $images = Storage::disk('local')->delete('public/field/images/'.$basename);
            //upload image baru
            $image = $request->file('img');
            $img = $image->hashName();
            $image->storeAs('public/field/images', $img);
            //update dengan image
            $field = Field::findOrFail($id);
            $field->update([
                'img'         => $img,
                'name'        => $request->input('name'),
                'slug'        => Str::slug($request->input('name')),
                'description' => $request->input('description'),
                'status'      => $request->input('status'),
            ]);
        }
        return redirect()->route('admin.field.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(QueryException $e){
        $error = $e->getMessage();
        return redirect()->route('admin.field.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $field = Field::find($id);
        $field->delete();
        return redirect()->route('admin.field.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.field.list')->with(['error' => $error]);
      }
    }
    
}

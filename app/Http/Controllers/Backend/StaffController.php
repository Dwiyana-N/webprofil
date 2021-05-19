<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Field;
use App\Models\Staff;
use Str;
use Auth;

class StaffController extends Controller
{
    public function index(){
      try{
        $data['list'] = Staff::orderBy('created_at', 'DESC')->get();
        return view('admin.unitkerja.pegawai.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $data['fetch'] = Staff::where('id', $id)->first();
        return view('admin.unitkerja.pegawai.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        $data['field'] = Field::where('status','show')->get();
        return view('admin.unitkerja.pegawai.create', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{
        //upload image
        if(!empty($request->file('photo'))){
          $image = $request->file('photo');
          $img = $image->hashName();
          $image->storeAs('public/staff/images', $img);
        } else {
          $img = null;
        }
        $data = $this->bindData($request);
        $data['photo'] = $img;
        $store = Staff::create($data);
        return redirect()->route('admin.staff.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $data['field'] = Field::where('status','show')->get();
        $data['fetch'] = Staff::where('id', $id)->first();
        return view('admin.unitkerja.pegawai.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $staff = Staff::where('id',$id)->first();
        //cek jika image kosong
        if($request->file('photo') == '') {
            //update tanpa image
            $staff = Staff::findOrFail($id);
            $data = $this->bindData($request);
            $staff->update($data);
        } else {
            //hapus image lama
            $basename = basename($staff->photo);
            $images = Storage::disk('local')->delete('public/staff/images/'.$basename);
            //upload image baru
            $image = $request->file('photo');
            $img = $image->hashName();
            $image->storeAs('public/staff/images', $img);
            //update dengan image
            $staff = Staff::findOrFail($id);
            $data = $this->bindData($request);
            $data['photo'] = $img;
            $staff->update($data);
        }
        return redirect()->route('admin.staff.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(QueryException $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $field = Staff::find($id);
        $field->delete();
        return redirect()->route('admin.staff.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.staff.list')->with(['error' => $error]);
      }
    }

    public function bindData($request)
    {
      if(!empty($request->id)){
          $get = Staff::find($request->id);
      }
        $data = [
            'field_id'    => $request->input('field_id'),
            'name'        => $request->input('name'),
            'nip'         => $request->input('nip'),
            'golongan'    => $request->input('golongan'),
            'position'    => $request->input('position'),
            'birthplace'  => $request->input('birthplace'),
            'birthday'    => $request->input('birthday'),
            'phone'       => $request->input('phone'),
            'email'       => $request->input('email'),
            'address'     => $request->input('address'),
            'status'      => $request->input('status'),
            'kategori'    => $request->input('kategori'),
        ];
        return $data;
    }
}

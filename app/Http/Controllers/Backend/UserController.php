<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Str;
use Auth;

class UserController extends Controller
{

    public function create(){
      try{
        return view('admin.pengguna.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function store(Request $request){
      try{
        $role = $request->role;
        $data = [
          'username'  => $request->input('username'),
          'name'      => $request->input('name'),
          'email'     => $request->input('email'),
          'password'  => bcrypt($request->input('username')),
        ];
        $store = User::create($data);
        $store->assignRole($role);
        return redirect()->route('admin.user.setting')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function edit($id){
      try{
        $data['fetch'] = User::where('id',$id)->first();
        return view('admin.pengguna.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function update(Request $request){
      try{
        $role = $request->role;
        $id = $request->id;
        $data = [
          'username'  => $request->input('username'),
          'name'      => $request->input('name'),
          'email'     => $request->input('email'),
          'password'  => bcrypt($request->input('username')),
        ];
        $user = User::findOrFail($id);
        $user->update($data);
        $user->syncRoles($role);
        return redirect()->route('admin.user.setting')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success'=>'Data berhasil dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function settings(){
      try{
        $user = Auth::user();
        $id = $user->id;
        $data['fetch'] = User::where('id', $id)->first();
        $data['list'] = User::role(['admin','operator'])->get();
        return view('admin.pengguna.setting', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function updateSettings(Request $request){
      try{
        $id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;
        $pass = $request->input('current_password');
        $data = [
          'username'  => $request->input('username'),
          'name'      => $request->input('name'),
          'email'     => $request->input('email'),
          'password'  => bcrypt($request->input('password')),
        ];
        if(!\Hash::check($pass, $hashedPassword)){
          return redirect()->back()->with(['error' => 'Gagal, password tidak sesuai.']);
        }else{
          $update = User::findOrFail($id);
          $update->update($data);
          return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
        }
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }
}

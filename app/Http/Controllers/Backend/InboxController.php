<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inbox;

class InboxController extends Controller
{
    public function index(){
      try{
        $data['inbox'] = Inbox::latest()->get();
        return view('admin.pesan.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.inbox.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $status = ['status' => 'read'];
        $inbox = Inbox::findOrFail($id);
        $inbox->update($status);
        $data['inbox'] = Inbox::findOrFail($id);
        return view('admin.pesan.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.inbox.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $inbox = Inbox::find($id);
        $inbox->delete();
        return redirect()->route('admin.inbox.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.inbox.list')->with(['error' => $error]);
      }
    }
}

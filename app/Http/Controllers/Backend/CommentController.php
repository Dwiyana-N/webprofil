<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Str;
use Auth;

class CommentController extends Controller
{
    public function index(){
      try{
        $data['comment'] = Comment::latest()->get();
        return view('admin.postingan.komentar.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.comment.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $data['komentar'] = Comment::where('id', $id)->first();
        return view('admin.postingan.komentar.detail', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.comment.list')->with(['error' => $error]);
      }
    }

    public function reply(Request $request){
      try{
        $id = $request->input('id');
        $comment = Comment::where('id',$id)->first();
        $data = [
              'author'  => Auth::user()->name,
              'reply'   => $request->input('reply'),
              'status'  => $request->input('status'),
        ];
        $comment->update($data);
        return redirect()->route('admin.comment.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.comment.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('admin.comment.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.comment.list')->with(['error'=>$error]);
      }
    }
}

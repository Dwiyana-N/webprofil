<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;
use Str;
use Auth;
use DB;

class SliderController extends Controller
{
    public function index(){
      try{
        $data['slider'] = Slider::orderBy('created_at', 'DESC')->get();
        return view('admin.slider.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        return view('admin.slider.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      DB::beginTransaction();
      try{
        $data = $this->bindData($request);
        $data['uploaded_by'] = Auth::user()->name;
        $slider = Slider::create($data);
        DB::commit();
        return redirect()->route('admin.slider.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $image = Storage::disk('local')->delete('public/slider/images/'.$data->img);
        DB::rollback();
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $slider = Slider::findOrFail($id);
        $basenameImg = basename($slider->img);
        $image = Storage::disk('local')->delete('public/slider/images/'.$basenameImg);
        $slider->delete();
        return redirect()->route('admin.slider.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $slider = Slider::findOrFail($id);
        return view('admin.slider.detail', compact('slider'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function active($id){
      try{
        $slider = Slider::findOrFail($id);
        $slider->update(['status'=>'show']);
        return redirect()->route('admin.slider.list')->with(['success' => 'Slider Diaktifkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function inactive($id){
      try{
        $slider = Slider::findOrFail($id);
        $slider->update(['status'=>'hide']);
        return redirect()->route('admin.slider.list')->with(['success' => 'Slider Dinonaktifkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function bindData($request){
      if(!empty($request->id)){
          $slider = Slider::find($request->id);
      }
      //upload image
      if(!empty($request->file('img'))){
        $image = $request->file('img');
        $img = $image->hashName();
        $image->storeAs('public/slider/images', $img);
      } else {
        $img = null;
      }
      $data = [
            'name'             => $request->input('name'),
            'description'       => $request->input('description'),
            'img'               => $img,
            'status'            => $request->input('status'),
      ];
      return $data;
    }
}

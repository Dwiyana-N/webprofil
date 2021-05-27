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

    public function edit($id){
      try{
        $data['slider'] = Slider::findOrFail($id);
        return view('admin.slider.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.slider.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $slider = Slider::where('id',$id)->first();
        //cek jika image dan file kosong
        if($request->file('img')=='' && $request->file('file')=='') {
          //update tanpa image
          $slider = Slider::findOrFail($id);
          $data = $this->bindData($request);
          $data['updated_by'] = Auth::user()->name;          
          $slider->update($data);
        } else if(!empty($request->file('img')) && $request->file('file')=='') { 
          //hapus image lama
          $basename = basename($slider->img);            
          $images = Storage::disk('local')->delete('public/slider/images/'.$basename);
          $thumb_path = public_path('thumbnails/'.$announce->thumbnail);
          if(File::exists($thumb_path)) {
              File::delete($thumb_path);
          }
          //upload image baru
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/slider/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
          //update dengan image       
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['thumbnail'] = $img;
          $data['updated_by'] = Auth::user()->name;
          $slider = Slider::findOrFail($id);
          $slider->update($data);
        } else if(!empty($request->file('file')) && $request->file('img')=='') {
          //hapus file lama
          $basenameFile = basename($announce->file);            
          $file = Storage::disk('local')->delete('public/slider/images/'.$basenameFile);          
          //upload file baru
          $input = $request->file('file');
          $extension = $input->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $input->storeAs('public/slider/files', $file);         
          //update dengan file       
          $data = $this->bindData($request);
          $data['file'] = $file;          
          $data['updated_by'] = Auth::user()->name;
          $slider = Slider::findOrFail($id);
          $slider->update($data);
        } else {
          //hapus data lama
          $basenameFile = basename($announce->file);            
          $file = Storage::disk('local')->delete('public/slider/images/'.$basenameFile);
          $basename = basename($announce->img);            
          $images = Storage::disk('local')->delete('public/slider/images/'.$basename);
          $thumb_path = public_path('thumbnails/'.$announce->thumbnail);
          if(File::exists($thumb_path)) {
              File::delete($thumb_path);
          }
          //upload data baru
          $image = $request->file('img');
          $extension = $image->getClientOriginalExtension();
          $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $image->storeAs('public/slider/images', $img);
          $thumbnailPath = 'thumbnails/';                       
          $thumb = Image::make($request->file('img'))->resize(250, 250)->save($thumbnailPath.$img);
          $input = $request->file('file');
          $extension = $input->getClientOriginalExtension();
          $file = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
          $input->storeAs('public/slider/files', $file);        
          //update       
          $data = $this->bindData($request);
          $data['img'] = $img;
          $data['thumbnail'] = $img;
          $data['file'] = $file;          
          $data['updated_by'] = Auth::user()->name;
          $slider = Slider::findOrFail($id);
          $slider->update($data);
        }        
        return redirect()->route('admin.slider.list')->with(['success' => 'Data Berhasil Disimpan!']);
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

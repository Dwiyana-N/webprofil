<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Agenda;
use Str;
use Auth;

class AgendaController extends Controller
{
    public function index(){
      try{
        $data['agenda'] = Agenda::orderBy('created_at', 'DESC')->get();
        return view('admin.agenda.list', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.agenda.list')->with(['error' => $error]);
      }
    }

    public function show($id){
      try{
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.detail', compact('agenda'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.announcement.list')->with(['error' => $error]);
      }
    }

    public function create(){
      try{
        return view('admin.agenda.create');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.agenda.list')->with(['error' => $error]);
      }
    }

    public function store(Request $request){
      try{
        //upload image
        if(!empty($request->file('img'))){
          $image = $request->file('img');
          $img = $image->hashName();
          $image->storeAs('public/agenda/images', $img);
        } else {
          $img = null;
        }
        $data['img'] = $img;
        $data = $this->bindData($request);
        $data['created_by'] = Auth::user()->name;
        $agenda = Agenda::create($data);
        return redirect()->route('admin.agenda.list')->with(['success' => 'Data Berhasil Ditambahkan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.agenda.list')->with(['error' => $error]);
      }
    }

    public function edit($id){
      try{
        $data['agenda'] = Agenda::findOrFail($id);
        return view('admin.agenda.edit', $data);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.agenda.list')->with(['error' => $error]);
      }
    }

    public function update(Request $request){
      try{
        $id = $request->input('id');
        $agenda = Agenda::where('id',$id)->first();
        //cek jika image kosong
        if($request->file('img') == '') {
            //update tanpa image          
            $data = $this->bindData($request);
            $data['updated_by'] = Auth::user()->name;
            $agenda = Agenda::findOrFail($id);
            $agenda->update($data);
        } else {
            //hapus image lama
            $basename = basename($agenda->img);            
            $images = Storage::disk('local')->delete('public/agenda/images/'.$basename);            
            //upload image baru
            $image = $request->file('img');
            $extension = $image->getClientOriginalExtension();
            $img = \Carbon\carbon::now()->translatedFormat('dmY').'-('.Str::camel($request->title).').'.$extension;
            $image->storeAs('public/agenda/images', $img);           
            //update dengan image       
            $data = $this->bindData($request);
            $data['img'] = $img;            
            $data['updated_by'] = Auth::user()->name;
            $agenda = Agenda::findOrFail($id);
            $agenda->update($data);;
        }           
        return redirect()->route('admin.agenda.list')->with(['success' => 'Data Berhasil Disimpan!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.agenda.list')->with(['error' => $error]);
      }
    }

    public function delete(Request $request){
      try{
        $id = $request->input('id');
        $agenda = Agenda::find($id);
        $basename = basename($agenda->img);
        $image = Storage::disk('local')->delete('public/agenda/images/'.$basename);
        $agenda->delete();
        return redirect()->route('admin.agenda.list')->with(['success' => 'Data Berhasil Dihapus!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('admin.agenda.list')->with(['error' => $error]);
      }
    }

    public function bindData($request){
      if(!empty($request->id)){
          $agenda = Agenda::find($request->id);
      }
      $tgl_mulai = $request->input('start_date');
      $jam_mulai = $request->input('start_time');
      $tgl_akhir = $request->input('end_date');
      $jam_akhir = $request->input('end_time');
      $start_date = sprintf('%s %s', $tgl_mulai, $jam_mulai);
      $end_date = sprintf('%s %s', $tgl_akhir, $jam_akhir);
      $data = [
            'title'             => $request->input('title'),
            'slug'              => Str::slug($request->input('title')),
            'description'       => $request->input('description'),
            'location'          => $request->input('location'),
            'start_date'        => $start_date,
            'end_date'          => $end_date,
            'status'            => $request->input('status'),
      ];
      return $data;
    }
}

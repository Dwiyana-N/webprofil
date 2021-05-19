<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Website;
use App\Models\SocialMedia;
use Str;
use Auth;

class WebsiteController extends Controller
{
    public function index(){
      try{
        $fetch = Website::latest()->first();

        return view('admin.website', compact('fetch'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error'=>$error]);
      }
    }

    public function simpan(Request $request){
      try{
        $website = Website::latest()->first();
		//dd($request->all());        
        if(empty($website)){
			//upload logo
			if($request->file('logo') == '' ){			  
			  $img = null;			  
			} else {
			  $logo = $request->file('logo');
			  $img = $logo->hashName();			  
			  $logo->storeAs('public/website/', $img);
			}   
			//upload favicon
			if($request->file('favicon') == '' ) {			  
			  $icon = null;			  
			} else {
			  $favicon = $request->file('favicon');
			  $icon = $favicon->hashName();			 
			  $favicon->storeAs('public/website/', $icon);
			}
            $data = $this->bindData($request);
            $data['logo'] = $img;
            $data['favicon'] = $icon;
            $website = Website::create($data);
        }else{
			//update logo
			if($request->file('logo') == '' ){
			  if($website->logo){
				$img = $website->logo;
			  }else{
				$img = null;
			  }
			} else {
			  $logo = $request->file('logo');
			  $img = $logo->hashName();
			  $baselogo = basename($website->logo);
			  $logopic = Storage::disk('local')->delete('public/website/'.$baselogo);
			  $logo->storeAs('public/website/', $img);
			}      
			//update favicon
			if($request->file('favicon') == '' ) {
			  if($website->favicon){
				$icon = $website->favicon;
			  }else{
				$icon = null;
			  }
			} else {
			  $favicon = $request->file('favicon');
			  $icon = $favicon->hashName();
			  $baseicon = basename($website->favicon);
			  $iconpic = Storage::disk('local')->delete('public/website/'.$baseicon);
			  $favicon->storeAs('public/website/', $icon);
			}
            $data = $this->bindData($request);
            $data['logo'] = $img;
            $data['favicon'] = $icon;
            $data['updated_by'] = Auth::user()->name;
            $website->update($data);
        }
        return redirect()->back()->with(['success'=> 'Data Berhasil Disimpan']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => html_entity_decode($error)]);
      }
    }

    public function bindData($request){

      $data = [
          'name'        => $request->input('name'),
          'phone'       => $request->input('phone'),
          'fax'         => $request->input('fax'),
          'email'       => $request->input('email'),
          'tagline'     => $request->input('tagline'),
          'description' => $request->input('description'),
          'address'     => $request->input('address'),
      ];

      return $data;
    }

}

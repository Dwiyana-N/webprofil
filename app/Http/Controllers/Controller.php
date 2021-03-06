<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

      function __construct()
      {
          $this->setUsers();
          View::share('visitors', $this->getAllVisitors());
          View::share('visitorToday', $this->getVisitorsToday());
          View::share('userOnline', $this->getUserOnline());
          View::share('hitToday', $this->hitToday());
          View::share('totalHit', $this->totalHit());
          View::share('favicon', $this->favicon());
          View::share('logo', $this->logo());
          View::share('getsitus', $this->getsitus());
          View::share('getsosmed', $this->getsosmed());
		      View::share('profils', $this->getProfil());
          View::share('pelayanan_menu', $this->getPelayanan());
          View::share('Kesenian', $this->getKesenian());
          View::share('Budaya', $this->getBudaya());
          View::share('wisata', $this->getWisata());
          View::share('objek', $this->getObjek());
          View::share('hotel', $this->getHotel());
          View::share('penginapan', $this->getPenginapan());
          View::share('rm', $this->getRumahMakan());
          View::share('makanan', $this->getMakanan());
          View::share('desa', $this->getDesa());
          View::share('tempat', $this->getTempat());
        }

      public function setUsers(){
           $date = \Carbon\Carbon::now()->format('Y-m-d');
           $ip = \Request::ip();
           $time = time();
           $data = [
               'ip' => $ip,
               'date' => $date,
               'online' => $time,
               'hit' => 1
           ];
           $user = \App\Models\Visitor::where('ip',$ip)->where('date',$date)->get();
           if(count($user) == 0){
                $insertUser = \App\Models\Visitor::insert($data);
           }else{
                $data['hit'] = $user[0]->hit + 1;
                $updateUser = \App\Models\Visitor::where('ip',$ip)->where('date',$date)->update($data);
           }
        }

        public function getAllVisitors(){
            $visitors = \App\Models\Visitor::count('ip');
            return $visitors;
        }

        public function getVisitorsToday(){
            $visitorToday = \App\Models\Visitor::where('date',\Carbon\Carbon::now()->format('Y-m-d'))->count();
            return $visitorToday;
        }

        public function getUserOnline(){
            $time = time() - 300;
            $userOnline = \App\Models\Visitor::where('online','>',$time)->count();
            return $userOnline;
        }

        public function hitToday(){
            $hitToday = \App\Models\Visitor::where('date',\Carbon\Carbon::now()->format('Y-m-d'))->sum('hit');
            return $hitToday;
        }

        public function totalHit(){
            $totalHit = \App\Models\Visitor::sum('hit');
            return $totalHit;
        }

        public function getsosmed(){
          $sosmed = \App\Models\SocialMedia::where('status','show')->latest()->get();
          return $sosmed;
        }

        public function getsitus(){
            $situs = \App\Models\Website::latest()->first();
            if(empty($situs)){
              return 0;
            }else{
              return $situs;
            }
        }

        public function favicon(){
            $web = \App\Models\Website::latest()->first();
            if(empty($web)){
              return 0;
            }else{
              return $favicon = $web->favicon;
            }
        }

        public function logo(){
            $web = \App\Models\Website::latest()->first();
            if(empty($web)){
              return 0;
            }else{
              return $logo = $web->logo;
            }
        }

		public function getProfil(){
			$profil = \App\Models\Profile::where('status','show')->get();
			return $profil;
		}

    public function getPelayanan(){
			$pelayanan = \App\Models\Pelayanan::where('status','show')->get();
			return $pelayanan;
		}
    
    public function getKesenian(){
			$seni = \App\Models\Kesenian::where('status','show')->get();
			return $seni;
		}
    public function getBudaya(){
			$budaya = \App\Models\Budaya::where('status','show')->get();
			return $budaya;
		}
    
    public function getObjek(){
			$objek = \App\Models\Objek::where('status','show')->get();
			return $objek;
		}
    
    public function getWisata(){
			$wisata = \App\Models\Wisata::where('status','show')->get();
			return $wisata;
		}
    
    public function getHotel(){
			$hotel = \App\Models\Hotel::where('status','show')->get();
			return $hotel;
		}
    
    public function getPenginapan(){
			$penginapan = \App\Models\Penginapan::where('status','show')->get();
			return $penginapan;
		}
    
    public function getRumahMakan(){
			$rm = \App\Models\RumahMakan::where('status','show')->get();
			return $rm;
		}
    
    public function getMakanan(){
			$makanan = \App\Models\Makanan::where('status','show')->get();
			return $makanan;
		}
    public function getDesa(){
			$desa = \App\Models\Desa::where('status','show')->get();
			return $desa;
		}
    public function getTempat(){
			$tempat = \App\Models\Tempat::where('status','show')->get();
			return $tempat;
		}
}

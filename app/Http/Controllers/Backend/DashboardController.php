<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Album;
use App\Models\Foto;
use App\Models\Video;
use App\Models\InfoGraphic;
use App\Models\Field;
use App\Models\Staff;
use App\Models\Visitor;
use Auth;
use Str;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['role:super-admin|admin|operator']);
    }

    public function index(){
        $data['countunit'] = Field::count();
        $data['countpegawai'] = Staff::count();
		    $data['countartikel'] = Article::count();
        $data['countagenda'] = Agenda::count();
        $data['countpengumuman'] = Announcement::count();
        $data['countalbum'] = Album::count();
        $data['countfoto'] = Foto::count();
        $data['countvideo'] = Video::count();
        $data['countinfografis'] = InfoGraphic::count();
		    $data['visitor'] = Visitor::all();
        return view('admin.dashboard', $data);
    }
}

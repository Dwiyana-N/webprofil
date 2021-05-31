<?php
//namespace controller disematkan/dipanggil dulu sebelum bisa digunakan jika mememakai cara pemanggilan controller seperti untuk backend dibawah
namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Route;
use Artisan;

//group route for "public frontend"
Route::namespace('Frontend')->group(static function () {
  Route::get('/', 'HomeController@index')->name('public.homepage');
  Route::post('/pencarian', 'HomeController@search')->name('public.search');
  Route::get('/kepegawaian/unit-kerja', 'HomeController@field')->name('public.field');
  Route::get('/kepegawaian/{slug}/list', 'HomeController@staff')->name('public.staff');
  Route::get('/kontak-kami', 'HomeController@contactUs')->name('public.contact');
  Route::post('/kontak-kami', 'HomeController@sendMessage')->name('public.sendmessage');
  //profil
  Route::get('/profil/{slug}', 'HomeController@profile')->name('public.profile');
  //desa
  Route::get('/desa/{slug}', 'HomeController@desa')->name('public.desa');
  //wisata
  Route::get('/wisata/{slug}', 'HomeController@wisata')->name('public.wisata');
   //pelayanan
   Route::get('/pelayanan/{slug}', 'HomeController@pelayanan')->name('public.pelayanan');
  //artikel
  Route::get('/artikel', 'ArticleController@index')->name('public.article.list');
  Route::get('/artikel/{slug}', 'ArticleController@show')->name('public.article.detail');
  Route::post('/artikel', 'ArticleController@sendComment')->name('public.article.comment');
  Route::get('/artikel/kategori/{category}', 'ArticleController@category')->name('public.article.category');
  Route::get('/artikel/tag/{tag}', 'ArticleController@tag')->name('public.article.tag');
  Route::get('/artikel/arsip/{year}/{month}', 'ArticleController@archive')->name('public.article.archive');
  //agenda
  Route::get('/agenda', 'AgendaController@index')->name('public.agenda.list');
  Route::get('/agenda/{slug}', 'AgendaController@show')->name('public.agenda.detail');
  //pengumuman
  Route::get('/pengumuman', 'AnnouncementController@index')->name('public.announcement.list');
  Route::get('/pengumuman/{slug}', 'AnnouncementController@show')->name('public.announcement.detail');
  //galeri
  Route::get('/album', 'AlbumController@index')->name('public.album.list');
  Route::get('/album/{slug}', 'AlbumController@foto')->name('public.album.detail');
  Route::get('/video', 'VideoController@index')->name('public.video.list');
  Route::get('/video/{slug}', 'VideoController@show')->name('public.video.detail');
  Route::get('/info-grafis', 'InfoGraphicController@index')->name('public.infographic.list');
  Route::get('/info-grafis/{slug}', 'InfoGraphicController@show')->name('public.infographic.detail');

});

//group route with prefix "admin" with different method to call the controller for "admin backend"
Route::prefix('admin')->namespace('Backend')->group(function () {
    //group route with middleware "auth" for "admin"
    Route::group(['middleware' => ['auth']], function() {
        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        //route Agenda
        Route::get('/agenda', [AgendaController::class, 'index'])->name('admin.agenda.list');
        Route::get('/agenda/detail/{id}', [AgendaController::class, 'show'])->name('admin.agenda.show');
        Route::get('/agenda/add', [AgendaController::class, 'create'])->name('admin.agenda.create');
        Route::post('/agenda/add', [AgendaController::class, 'store'])->name('admin.agenda.add');
        Route::get('/agenda/edit/{id}', [AgendaController::class, 'edit'])->name('admin.agenda.edit');
        Route::post('/agenda/edit', [AgendaController::class, 'update'])->name('admin.agenda.update');
        Route::post('/agenda/delete', [AgendaController::class, 'delete'])->name('admin.agenda.delete');
        //route Pengumuman
        Route::get('/announcement', [AnnouncementController::class, 'index'])->name('admin.announcement.list');
        Route::get('/announcement/detail/{id}', [AnnouncementController::class, 'show'])->name('admin.announcement.show');
        Route::get('/announcement/add', [AnnouncementController::class, 'create'])->name('admin.announcement.create');
        Route::post('/announcement/add', [AnnouncementController::class, 'store'])->name('admin.announcement.add');
        Route::get('/announcement/edit/{id}', [AnnouncementController::class, 'edit'])->name('admin.announcement.edit');
        Route::post('/announcement/edit', [AnnouncementController::class, 'update'])->name('admin.announcement.update');
        Route::post('/announcement/delete', [AnnouncementController::class, 'delete'])->name('admin.announcement.delete');
        //route Slider
        Route::get('/slider', [SliderController::class, 'index'])->name('admin.slider.list');
        Route::get('/slider/detail/{id}', [SliderController::class, 'show'])->name('admin.slider.show');
        Route::get('/slider/add', [SliderController::class, 'create'])->name('admin.slider.create');
        Route::post('/slider/add', [SliderController::class, 'store'])->name('admin.slider.add');
        Route::get('/slider/edit', [SliderController::class, 'edit'])->name('admin.slider.edit');
        Route::post('/slider/edit', [SliderController::class, 'update'])->name('admin.slider.update');
        Route::post('/slider/delete', [SliderController::class, 'delete'])->name('admin.slider.delete');
        Route::get('/slider/active/{id}', [SliderController::class, 'active'])->name('admin.slider.active');
        Route::get('/slider/inactive/{id}', [SliderController::class, 'inactive'])->name('admin.slider.inactive');
        //route Inbox
        Route::get('/inbox', [InboxController::class, 'index'])->name('admin.inbox.list');
        Route::get('/inbox/detail/{id}', [InboxController::class, 'show'])->name('admin.inbox.show');
        Route::post('/inbox/delete', [InboxController::class, 'delete'])->name('admin.inbox.delete');
        // ==== GALERI ====
        // Album
        Route::get('/album', [AlbumController::class, 'index'])->name('admin.album.list');
        Route::get('/album/detail/{id}', [AlbumController::class, 'show'])->name('admin.album.show');
        Route::get('/album/add', [AlbumController::class, 'create'])->name('admin.album.create');
        Route::post('/album/add', [AlbumController::class, 'store'])->name('admin.album.add');
        Route::get('/album/edit/{id}', [AlbumController::class, 'edit'])->name('admin.album.edit');
        Route::post('/album/edit', [AlbumController::class, 'update'])->name('admin.album.update');
        Route::post('/album/delete', [AlbumController::class, 'delete'])->name('admin.album.delete');
        // Foto
        Route::get('/photo/detail/{id}', [PhotoController::class, 'show'])->name('admin.photo.show');
        Route::get('/photo/add', [PhotoController::class, 'create'])->name('admin.photo.create');
        Route::post('/photo/add', [PhotoController::class, 'store'])->name('admin.photo.add');
        Route::get('/photo/edit/{id}', [PhotoController::class, 'edit'])->name('admin.photo.edit');
        Route::post('/photo/edit', [PhotoController::class, 'update'])->name('admin.photo.update');
        Route::post('/photo/delete', [PhotoController::class, 'delete'])->name('admin.photo.delete');
        // Video
        Route::get('/video', [VideoController::class, 'index'])->name('admin.video.list');
        Route::get('/video/detail/{id}', [VideoController::class, 'show'])->name('admin.video.show');
        Route::get('/video/add', [VideoController::class, 'create'])->name('admin.video.create');
        Route::post('/video/add', [VideoController::class, 'store'])->name('admin.video.add');
        Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('admin.video.edit');
        Route::post('/video/edit', [VideoController::class, 'update'])->name('admin.video.update');
        Route::post('/video/delete', [VideoController::class, 'delete'])->name('admin.video.delete');
        // Info Grafis
        Route::get('/infographic', [InfoGraphicController::class, 'index'])->name('admin.infographic.list');
        Route::get('/infographic/detail/{id}', [InfoGraphicController::class, 'show'])->name('admin.infographic.show');
        Route::get('/infographic/add', [InfoGraphicController::class, 'create'])->name('admin.infographic.create');
        Route::post('/infographic/add', [InfoGraphicController::class, 'store'])->name('admin.infographic.add');
        Route::get('/infographic/edit/{id}', [InfoGraphicController::class, 'edit'])->name('admin.infographic.edit');
        Route::post('/infographic/edit', [InfoGraphicController::class, 'update'])->name('admin.infographic.update');
        Route::post('/infographic/delete', [InfoGraphicController::class, 'delete'])->name('admin.infographic.delete');
        // ==== KONTEN ARTIKEL/BERITA PUBLIKASI ====
        // kategori
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.list');
        Route::get('/category/add', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/add', [CategoryController::class, 'store'])->name('admin.category.add');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/category/edit', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::post('/category/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
        // tag
        Route::get('/tag', [TagController::class, 'index'])->name('admin.tag.list');
        Route::get('/tag/add', [TagController::class, 'create'])->name('admin.tag.create');
        Route::post('/tag/add', [TagController::class, 'store'])->name('admin.tag.add');
        Route::get('/tag/edit/{id}', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::post('/tag/edit', [TagController::class, 'update'])->name('admin.tag.update');
        Route::post('/tag/delete', [TagController::class, 'delete'])->name('admin.tag.delete');
        // artikel
        Route::get('/article', [ArticleController::class, 'index'])->name('admin.article.list');
        Route::get('/article/show/{id}', [ArticleController::class, 'show'])->name('admin.article.show');
        Route::get('/article/add', [ArticleController::class, 'create'])->name('admin.article.create');
        Route::post('/article/add', [ArticleController::class, 'store'])->name('admin.article.add');
        Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('admin.article.edit');
        Route::post('/article/edit', [ArticleController::class, 'update'])->name('admin.article.update');
        Route::post('/article/delete', [ArticleController::class, 'delete'])->name('admin.article.delete');
        Route::get('/article/trash', [ArticleController::class, 'trash'])->name('admin.trash.list');
        Route::get('/article/restore/{id}', [ArticleController::class, 'restore'])->name('admin.trash.restore');
        Route::post('/article/destroy', [ArticleController::class, 'destroy'])->name('admin.trash.destroy');
        // komentar
        Route::get('/comment', [CommentController::class, 'index'])->name('admin.comment.list');
        Route::post('/comment/reply', [CommentController::class, 'reply'])->name('admin.comment.reply');
        Route::get('/comment/show/{id}', [CommentController::class, 'show'])->name('admin.comment.show');
        Route::get('/comment/hide', [CommentController::class, 'hide'])->name('admin.comment.hide');
        Route::post('/comment/delete', [CommentController::class, 'delete'])->name('admin.comment.delete');
        // === DATA MASTER ===
        // Bidang
        Route::get('/field', [FieldController::class, 'index'])->name('admin.field.list');
        Route::get('/field/show/{id}', [FieldController::class, 'show'])->name('admin.field.show');
        Route::get('/field/add', [FieldController::class, 'create'])->name('admin.field.create');
        Route::post('/field/add', [FieldController::class, 'store'])->name('admin.field.add');
        Route::get('/field/edit/{id}', [FieldController::class, 'edit'])->name('admin.field.edit');
        Route::post('/field/edit', [FieldController::class, 'update'])->name('admin.field.update');
        Route::post('/field/delete', [FieldController::class, 'delete'])->name('admin.field.delete');
        // Pegawai
        Route::get('/staff', [StaffController::class, 'index'])->name('admin.staff.list');
        Route::get('/staff/show/{id}', [StaffController::class, 'show'])->name('admin.staff.show');
        Route::get('/staff/add', [StaffController::class, 'create'])->name('admin.staff.create');
        Route::post('/staff/add', [StaffController::class, 'store'])->name('admin.staff.add');
        Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('admin.staff.edit');
        Route::post('/staff/edit', [StaffController::class, 'update'])->name('admin.staff.update');
        Route::post('/staff/delete', [StaffController::class, 'delete'])->name('admin.staff.delete');

        // == SETTINGS ==
        // Website
        Route::get('/website', [WebsiteController::class, 'index'])->name('admin.website.setting');
        Route::post('/website', [WebsiteController::class, 'simpan'])->name('admin.website.save');
        // Social Media
        Route::get('/socialmedia', [SocialMediaController::class, 'index'])->name('admin.socmed.list');
        Route::get('/socialmedia/add', [SocialMediaController::class, 'create'])->name('admin.socmed.create');
        Route::post('/socialmedia/add', [SocialMediaController::class, 'store'])->name('admin.socmed.add');
        Route::get('/socialmedia/edit/{id}', [SocialMediaController::class, 'edit'])->name('admin.socmed.edit');
        Route::post('/socialmedia/edit', [SocialMediaController::class, 'update'])->name('admin.socmed.update');
        Route::post('/socialmedia/delete', [SocialMediaController::class, 'delete'])->name('admin.socmed.delete');
        // Profil
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.list');
        Route::get('/profile/show/{id}', [ProfileController::class, 'show'])->name('admin.profile.show');
        Route::get('/profile/add', [ProfileController::class, 'create'])->name('admin.profile.create');
        Route::post('/profile/add', [ProfileController::class, 'store'])->name('admin.profile.add');
        Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile/edit', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::post('/profile/delete', [ProfileController::class, 'delete'])->name('admin.profile.delete');
        // Wisata
        Route::get('/wisata', [WisataController::class, 'index'])->name('admin.wisata.list');
        Route::get('/wisata/show/{id}', [WisataController::class, 'show'])->name('admin.wisata.show');
        Route::get('/wisata/add', [WisataController::class, 'create'])->name('admin.wisata.create');
        Route::post('/wisata/add', [WisataController::class, 'store'])->name('admin.wisata.add');
        Route::get('/wisata/edit/{id}', [WisataController::class, 'edit'])->name('admin.wisata.edit');
        Route::post('/wisata/edit', [WisataController::class, 'update'])->name('admin.wisata.update');
        Route::post('/wisata/delete', [WisataController::class, 'delete'])->name('admin.wisata.delete');
        // Pelayanan
        Route::get('/pelayanan', [PelayananController::class, 'index'])->name('admin.pelayanan.list');
        Route::get('/pelayanan/show/{id}', [PelayananController::class, 'show'])->name('admin.pelayanan.show');
        Route::get('/pelayanan/add', [PelayananController::class, 'create'])->name('admin.pelayanan.create');
        Route::post('/pelayanan/add', [PelayananController::class, 'store'])->name('admin.pelayanan.add');
        Route::get('/pelayanan/edit/{id}', [PelayananController::class, 'edit'])->name('admin.pelayanan.edit');
        Route::post('/pelayanan/edit', [PelayananController::class, 'update'])->name('admin.pelayanan.update');
        Route::post('/pelayanan/delete', [PelayananController::class, 'delete'])->name('admin.pelayanan.delete');
        // Desa
        Route::get('/desa', [DesaController::class, 'index'])->name('admin.desa.list');
        Route::get('/desa/show/{id}', [DesaController::class, 'show'])->name('admin.desa.show');
        Route::get('/desa/add', [DesaController::class, 'create'])->name('admin.desa.create');
        Route::post('/desa/add', [DesaController::class, 'store'])->name('admin.desa.add');
        Route::get('/desa/edit/{id}', [DesaController::class, 'edit'])->name('admin.desa.edit');
        Route::post('/desa/edit', [DesaController::class, 'update'])->name('admin.desa.update');
        Route::post('/desa/delete', [DesaController::class, 'delete'])->name('admin.desa.delete');
        // User
        Route::group(['middleware' => ['role:admin|super-admin']], function() {
            Route::get('/user/add', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/user/add', [UserController::class, 'store'])->name('admin.user.add');
            Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::post('/user/edit', [UserController::class, 'update'])->name('admin.user.update');
            Route::post('/user/delete', [UserController::class, 'delete'])->name('admin.user.delete');
        });
        // User Session
        Route::get('/user/setting', [UserController::class, 'settings'])->name('admin.user.setting');
        Route::post('/user/setting', [UserController::class, 'updateSettings'])->name('admin.user.updatesetting');
    });
});

Route::get('/storagelink', function () {
    Artisan::call('storage:link');
    return redirect()->back()->with(['success'=>'Storage Links have been created']);
});
Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    $message = "Configuration cache cleared!<br>Routes cache cleared!";
    return redirect()->back()->with(['success'=>$message]);
});
Route::get('/cacheclear', function () {
    Artisan::call('cache:clear');
    return redirect()->back()->with(['success'=>'Application cache cleared!']);
});
Route::get('/viewcache', function () {
    Artisan::call('view:cache');
    return redirect()->back()->with(['success'=>'Compiled views cleared!']);
});
Route::get('/configcache', function () {
    Artisan::call('config:cache');
    return redirect()->back()->with(['success'=>'Configuration cache cleared!']);
});

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'AnasayfaController@Index')->name('anasayfa');

Route::get('/kategori/{slug_kategoriadi}','KategoriController@index')->name('kategori');
Route::get('/urun/{slug_urunadi}','UrunController@index')->name('urun');

Route::post('/ara','UrunController@ara')->name('urun_ara');
Route::get('/ara','UrunController@ara')->name('urun_ara');

Route::prefix('sepet')->group(function () {
    Route::get('/','SepetController@index')->name('sepet')->middleware('auth');
    Route::post('/ekle','SepetController@ekle')->name('sepet.ekle');
    Route::delete('/kaldir/{rowid}','SepetController@kaldir')->name('sepet.kaldir');
    Route::delete('/bosalt','SepetController@bosalt')->name('sepet.bosalt');
    Route::patch('/guncelle/{rowid}','SepetController@guncelle')->name('sepet.guncelle');
});

Route::group(['middleware'=>'auth'], function () {
Route::get('/siparisler','SiparisController@index')->name('siparisler');
Route::get('/siparisler/{id}','SiparisController@detay')->name('siparis');
});

Route::get('/odeme','OdemeController@index')->name('odeme');

Route::post('/odeme','OdemeController@odemeyap')->name('odemeyap');

Route::prefix('kullanici')->group(function () {
Route::get('/oturumac','KullaniciController@giris_form')->name('kullanici.oturumac');
Route::post('/oturumac','KullaniciController@giris');
Route::get('/kaydol','KullaniciController@kaydol_form')->name('kullanici.kaydol');
Route::post('/kaydol','KullaniciController@kaydol');
Route::get('/aktiflestir/{anahtar}','KullaniciController@aktiflestir')->name('aktiflestir');
Route::post('/oturumkapat','KullaniciController@oturumkapat')->name('kullanici.oturumkapat');
});

Route::get('/test/mail', function(){
    $kullanici = \App\Models\Kullanici::find(1);
    return new App\Mail\KullaniciKayitMail($kullanici);
});
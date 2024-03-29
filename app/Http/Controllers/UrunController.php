<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Urun;

class UrunController extends Controller
{
    //
    public function index($slug_urunadi){
        
        $urun = Urun::whereSlug($slug_urunadi)->FirstOrFail();
        $kategoriler = $urun->kategoriler()->distinct()->get();
        return view('urun', compact('urun','kategoriler'));

    }

    public function ara(){

       /* $deger = request()->input('aranan');
        if($deger=="") {  
            $urunler = Urun::where('urun_adi','like',"%$aranan%")->orWhere('aciklama','like',"%$aranan%")->get();
            return view('arama',compact('urunler'))->with('hata', '0');
*/  

        $aranan = request()->input('aranan');
        $urunler = Urun::where('urun_adi','like',"%$aranan%")->orWhere('aciklama','like',"%$aranan%")->paginate(8);
        request()->flash();
        return view('arama', compact('urunler'));

    }
}

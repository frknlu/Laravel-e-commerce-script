<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index($slug_kategoriadi){


        $kategori = Kategori::where('slug',$slug_kategoriadi)->FirstOrFail();
        
        $alt_kategoriler = Kategori::where('ust_id',$kategori->id)->get();

        $order = request('order');

        if($order == "coksatanlar"){

            $urunler = $kategori->urunler()
            ->distinct()
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->orderBy('urun_detay.goster_cok_satan','desc')
            ->paginate(2);
        }
        else if ($order == "yeni"){
            $urunler = $kategori->urunler()->distinct()->orderByDesc('updated_at')->paginate(2);
        }
        else{
        $urunler = $kategori->urunler()->distinct()->paginate(2);
            }

        return view('kategori',compact('kategori','alt_kategoriler','urunler'));

        
    }
}

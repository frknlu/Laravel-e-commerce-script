<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis extends Model
{
    use SoftDeletes;

    protected $table = 'siparis';

    protected $fillable = ['sepet_id','siparis_tutari','adsoyad','adres','telefon','ceptelefon','durum','banka','taksit_sayisi'];

   /* protected $guarded = [];*/


    public function sepet()
    {
        return $this->belongsTo('App\Models\Sepet');
    }
    
}

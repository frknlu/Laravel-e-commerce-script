@extends('layouts.master')
@section('title','Sepet')
@section('content')


<div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')
            
            @if ( count(Cart::content())>0 )
                
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Ürün Adı</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>İşlem</th>
                </tr>

                @foreach (Cart::content() as $urunCartItem)

                <tr>
                    <td style="width: 120px;"><a href="{{ route('urun', $urunCartItem->options->slug)  }}"> <img src="http://via.placeholder.com/50x50?text=ÜrünResmi"></a></td>

                     <td> <a href="{{ route('urun', $urunCartItem->options->slug)  }}"> {{ $urunCartItem->name }} </a></td> 

                    <td>{{ $urunCartItem->price }} ₺</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id="{{ $urunCartItem->rowId }}" data-adet="{{ $urunCartItem->qty-1 }}" >-</a>
                        <span style="padding: 10px 20px">{{ $urunCartItem->qty }}</span>
                        <a href="#" class="btn btn-xs btn-default urun-adet-artir" data-id="{{ $urunCartItem->rowId }}" data-adet="{{ $urunCartItem->qty+1 }}" >+</a>
                    </td>
                    <td class="text-right">
                        {{ $urunCartItem->subtotal }} ₺
                    </td>
                    <td>
                        <form method="POST" action="{{ route('sepet.kaldir', $urunCartItem->rowId) }} ">
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <input type="submit" value="Sil" class="btn btn-danger btn-xs"/>
                         </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Tutar</th>
                    <th class="text-right">{{ Cart::subtotal() }} ₺</th>
                </tr>   
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <th class="text-right">{{ Cart::tax() }} ₺</th>
                </tr> 
                <tr>
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <th class="text-right">{{ Cart::total() }} ₺</th>
                </tr>   
                
            </table>

            <div>
                <form method="POST" action="{{ route('sepet.bosalt') }} ">
                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <input type="submit" value="Sepeti Boşalt" class="btn btn-info pull-left"/>
                 </form>

                <a href="{{ route('odeme')  }}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>

            @else
            <p>Sepetinizde ürün yok.</p>

            @endif
            
        </div>
    </div>

@endsection
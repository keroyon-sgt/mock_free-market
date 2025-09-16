@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="mypage__content">

    <div class="mypage__header">
        <div class="mypage__image">
            <img src="{{ asset('storage/' . $user->portrait_path) }}" alt="{{ $user['name'] }}" />
        </div>

        <div class="mypage__detail">
            <h2 class="mypage__name">{{ $user['name'] }}</h2>
        </div>
        <div class="mypage__button-edit">
            <button onclick="location.href='/mypage/profile'">プロフィールを編集</button>

        </div>
    </div>
    <ul class="section__tab">
@if ($request['page'] === 'buy')
        <li>
            <button class="section__tab-button" onclick="location.href='/mypage?page=sell'">出品した商品</button>
        </li>
        <li><button class="section__tab-button here-now">購入した商品</button></li>
@else
        <li>
            <button class="section__tab-button here-now">出品した商品</button>
        </li>
        <li>
            <button class="section__tab-button" onclick="location.href='/mypage?page=buy'">購入した商品</button>
        </li>
@endif
        
    </ul>
<hr>

<!-- ------------------------------------------------- -->


    <div class="item-box__place">
        <ul class="item-box__list">
    @foreach ($items as $item)
            <li class="item-box">
    <!-- _if($item['stock'])
                <a href="{{ route('item',['item_id' => $item['id'] ]) }}">
    _endif -->
@if($request['page'] !== 'buy')
    @if(!$item['stock'])
                    <div class="item-box__sold">
                        <img src="{{ asset('img/sold.png') }}" alt="SOLD" />
                    </div>
    @endif
                    <div class="item-box__image">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
                    </div>
                    <div class="item-box__title">{{ $item['title'] }}</div>
@else
                    <div class="item-box__image">
                        <img src="{{ asset('storage/' . $item->Item->image_path) }}" alt="{{ $item->Item->title }}" />
                    </div>
                    <div class="item-box__title">{{ $item->Item->title }}</div>
@endif

    <!-- _if($item['stock'])
                </a>
    _endif -->
    
            </li>
    @endforeach
        </ul>
    </div>


    <!-- ------------------------------------------------- -->


</div>
@endsection
